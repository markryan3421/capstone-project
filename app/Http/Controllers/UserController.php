<?php

namespace App\Http\Controllers;

use App\Models\Sdg;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
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
        $sdgs = Sdg::all();
        return view('users.create-user', compact('roles', 'sdgs'));
    }

    public function store(Request $request) {
        // Validate the incoming form data
        $incomingFields = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed'],
            'role' => ['required', 'exists:roles,name'], // Ensure role exists in 'roles' table
            'sdgs' => 'required|array|min:1',            // User must be assigned to at least one SDG
            'sdgs.*' => 'exists:sdgs,id',                // Each SDG must exist in 'sdgs' table
        ]);
    
        // Get the current SDG/tenant ID stored in session (set during login)
        $tenantId = session('tenant_id');
    
        // Determine which SDG from the request belongs to the current session tenant
        // If a match is found, use it as the current SDG. Otherwise, this will be null.
        $currentSdgId = collect($request->sdgs)
            ->filter(function ($sdgId) use ($tenantId) {
                return $sdgId == $tenantId;
            })
            ->first();
    
        // Create the user with basic info and set the current_sdg_id if matched
        $user = User::create([
            'name' => $incomingFields['name'],
            'email' => $incomingFields['email'],
            'password' => Hash::make($incomingFields['password']),
            'user_slug' => Str::slug($incomingFields['name']),
            'current_sdg_id' => Auth::id(), // May be null if tenant ID not in selected SDGs
        ]);
    
        // Assign the selected role to the user
        $user->assignRole($request->role);
    
        // Attach selected SDGs (tenants) to user via pivot table 'sdg_user'
        $user->sdgs()->sync($request->sdgs);
    
        // Redirect to user settings page with success message
        return redirect('/settings/users')->with('success', 'User created successfully!');
    }

    public function show(User $user) {
        $roles = Role::all();
        $user->load('sdgs');
        return view('users.show-user', compact('user', 'roles'));
    }

    public function edit(User $user) {
        $roles = Role::all();
        $sdgs = Sdg::all();
        $user->load('sdgs');
        return view('users.edit-user', compact('roles', 'sdgs', 'user'));
    }

    public function update(Request $request, User $user) {
        $incomingFields = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'sdgs' => 'sometimes|array',  // 'sometimes' makes it optional
            'sdgs.*' => 'exists:sdgs,id' // Validate each SDG ID exists
        ]);

        $incomingFields['user_slug'] = Str::slug($incomingFields['name']);

        $user->update($incomingFields);

        // Sync SDGs - will detach missing and attach new ones
        if ($request->has('sdgs')) {
            $user->sdgs()->sync($request->sdgs);
        } else {
            // If no SDGs submitted, detach all
            $user->sdgs()->detach();
        }

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
