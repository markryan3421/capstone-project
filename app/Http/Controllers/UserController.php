<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index() {
        $users = User::with('roles')->paginate(10);
        $roles = Role::all();

        return view('users.index', compact('users', 'roles'));
    }

    public function create() {
        $roles = Role::all();
        return view('users.create-user', compact('roles'));
    }

    public function store(Request $request) {
        $incomingFields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
            'role' => ['required', 'exists:roles,name'],
        ]);

        $user = User::create([
            'name' => $incomingFields['name'],
            'email' => $incomingFields['email'],
            'password' => Hash::make($incomingFields['password']),
            'user_slug' => Str::slug($incomingFields['name']),
        ]);

        $user->assignRole($request->role);

        return redirect('/settings/users')->with('success', 'User created successfully!');
    }

    public function show(User $user) {
        $roles = Role::all();

        return view('users.show-user', compact('user', 'roles'));
    }

    public function edit(User $user) {
        $roles = Role::all();
        return view('users.edit-user', compact('user', 'roles'));
    }

    public function update(Request $request, User $user) {
        $incomingFields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $incomingFields['user_slug'] = Str::slug($incomingFields['name']);

        $user->update($incomingFields);

        return redirect('/settings/users')->with('success', 'User updated successfully!');
    }

    public function assignRole(Request $request, User $user) {
        // Validate that the role exists in the roles table
        $validated = $request->validate([
            'role' => 'required|exists:roles,name',
        ]);

        // Update the user's role (replaces all current roles with the new one)
        $user->syncRoles([$validated['role']]);

        // Redirect back with a success message
        return redirect('/settings/users')->with('success', 'User role updated successfully!');
    }

    public function destroy(User $user) {
        if ($user->hasRole('admin')) {
            return redirect('/settings/users')->with('error', 'You cannot delete an admin user.');
        }
        
        $user->delete();
        return redirect('/settings/users')->with('success', 'User deleted successfully!');
    }
}
