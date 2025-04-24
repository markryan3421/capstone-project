<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index() {
        $roles = Role::with('permissions')->paginate(10);
        $permissions = Permission::all();
        
        return view('roles.index', compact('roles', 'permissions'));
    }

    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create-role', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name',
            'permissions' => 'array',
        ]);

        $role = Role::create(['name' => $request->name]);
        
        // Check if there's a permission checked
        if ($request->has('permissions')) {
            $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
            $role->syncPermissions($permissions);
        }

        return redirect('/settings/roles')->with('success', 'Role Created Successfully.');
    }

    public function show(Role $role) {
        // Eager load permissions to avoid N+1 query
        $role->load('permissions');

        // Get users with this role
        $users = User::role($role->name)->paginate(10);

        return view('roles.show-role', compact('role', 'users'));
    }

    public function edit(Role $role)
    {
        $role->load('permissions');
        $permissions = Permission::all();

        return view('roles.edit-role', compact('role', 'permissions'));
    }

    public function update(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:roles,name,' . $role->id,
            'permissions' => 'sometimes|array',
            'description' => 'nullable|string|max:255'
        ]);

        $role->update([
            'name' => $validatedData['name'],
            'description' => $validatedData['description'] ?? null
        ]);

        if (!empty($validatedData['permissions'])) {
            $role->syncPermissions($validatedData['permissions']);
        } else {
            $role->syncPermissions([]);
        }

        return redirect('settings/roles')->with('success', 'Role updated successfully.');
    }

    public function destroy(Role $role)
    {
        // Prevent deletion of admin role
        if ($role->name === 'admin') {
            return redirect('/settings/roles')->with('error', 'Cannot delete admin role.');
        }

        $role->delete();

        return redirect('/settings/roles')->with('success', 'Role deleted successfully.');
    }
}
