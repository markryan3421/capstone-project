<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function indexProfile(User $user) {
        // Load the goals assigned to them
        $user->load('sdgs', 'goals');
        $roles = $user->getRoleNames(); // Retrieve the roles assigned to the user

        return view('users.profile-view', compact('user', 'roles'));
    }

    public function editProfile(User $user) {
        return view('users.edit-user-profile', compact('user'));
    }

    public function updateProfile(Request $request, User $user) {
        // Validate the incoming form data
        $incomingFields = $request->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:3000',
            'name' => 'required|string|max:255',
            'password' => 'nullable|confirmed|min:8',
            'password_confirmation' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $incomingFields['user_slug'] = Str::slug($incomingFields['name']);

        // Handle avatar upload if a new image is provided
        $oldAvatar = $user->avatar;

        if ($request->hasFile('avatar')) {
            $filename = uniqid() . '.jpg';
            $img = Image::make($request->file('avatar'))->fit(120)->encode('jpg');
            Storage::disk('public')->put('avatars/' . $filename, $img);

            $user->avatar = $filename;

            if ($oldAvatar && $oldAvatar !== 'default-avatar.jpg') {
                Storage::disk('public')->delete('avatars/' . basename($oldAvatar));
            }

            // Prevent avatar from being overwritten by update() if null
            unset($incomingFields['avatar']);
        }

        $user->update($incomingFields);

        return redirect("profile/{{ $user->user_slug }}")
                         ->with('success', 'Profile updated successfully.');

    }
}
