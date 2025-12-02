<?php

namespace App\Http\Controllers;

use App\Models\Sdg;
use App\Models\Goal;
use App\Models\Task;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class SdgController extends Controller
{
    public function changeSdg($tenantID) {
        // Check Tenant/SDG
        $sdg = Auth::user()->sdgs()->findOrFail($tenantID);

        // Change Tenant
        Auth::user()->update(['current_sdg_id' => $sdg->id]);

        // Update Tenant in Session
        session(['sdg_id' => $sdg->id]);

        // Redirect
        return redirect('/')->with(['success' => 'Tenant changed successfully!']);
    }

    public function index() {
        // Get all SDGs for the authenticated user
        $sdgs = Auth::user()->sdgs;
        $totalGoals = Goal::count();
        $totalTasks = Task::count();

        // Return the view with the SDGs
        return view('sdgs', compact('sdgs', 'totalGoals', 'totalTasks'));
    }

    public function create() {
        return view('sdgs.create');
    }

    public function store(Request $request) {
        $incomingFields = $request->validate([
            'name' => 'required|string|max:255',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $filename = null;
        // Check if avatar image is uploaded
        if ($request->hasFile('cover_photo')) {
            $filename = uniqid() . '.jpg';
            $img = Image::make($request->file('cover_photo'))->fit(120)->encode('jpg');
            Storage::disk('public')->put("sdg-covers/$filename", $img);
        }

        $sdg = Sdg::create([
            'name' => $incomingFields['name'],
            'slug' => Str::slug($incomingFields['name']),
            'cover_photo' => $filename ?? 'default-cover.jpg',
        ]);

        $sdg->users()->attach(Auth::user()->id, [
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/sdgs')->with('success', 'SDG created successfully!');
    }

    public function edit(Sdg $sdg) {
        // Return the edit view with the SDG data
        return view('sdgs.edit', compact('sdg'));
    }

    public function update(Request $request, Sdg $sdg)
    {
        $incomingFields = $request->validate([
            'name' => 'required|string|max:255',
            'cover_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Update name and slug
        $sdg->name = $incomingFields['name'];
        $sdg->slug = Str::slug($incomingFields['name']);

        // Handle cover photo upload if there's a new file
        if ($request->hasFile('cover_photo')) {
            // Delete old image if it's not the default
            if ($sdg->cover_photo && $sdg->cover_photo !== 'default-cover.jpg') {
                Storage::disk('public')->delete("sdg-covers/{$sdg->cover_photo}");
            }

            $filename = uniqid() . '.jpg';
            $img = Image::make($request->file('cover_photo'))->fit(120)->encode('jpg');
            Storage::disk('public')->put("sdg-covers/{$filename}", $img);

            $sdg->cover_photo = $filename;
        }

        $sdg->save();

        return redirect('/sdgs')->with('success', 'SDG updated successfully!');
    }

    public function destroy(Sdg $sdg) {
        $sdg->delete();

        return redirect('/sdgs')->with('success', 'SDG deleted successfully!');
    }
}
