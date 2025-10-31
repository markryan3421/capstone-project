<?php

namespace App\Http\Controllers;

use App\Models\Sdg;
use App\Models\Goal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request) {
        $incomingFields = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        // Check if user exists
        if(Auth::attempt(['email' => $incomingFields['email'], 'password' => $incomingFields['password']])) {
            // Store cookies
            $request->session()->regenerate();
            $user = Auth::user();

             // If the user has no current_sdg_id yet, assign the first one they have
            if (!$user->current_sdg_id && $user->sdgs()->exists()) {
                $firstSdg = $user->sdgs()->first();
                $user->current_sdg_id = $firstSdg->id;
                $user->save();
                // $user->update(['current_sdg_id' => $firstSdg->id]);
            }

            // Set the SDG ID into session
            session(['sdg_id' => $user->current_sdg_id]);

            // Redirect back to homepage
            return redirect('/sdgs')->with(['success' => 'You are now logged in!']);
        } else {
            return redirect('/')->with(['error' => 'Invalid credentials']);
        }
    }

    public function logout() {
        // event(new ExampleEvent(['username' => Auth::user()->username, 'action' => 'logged out']));
        Auth::logout(); // log the user out
        return redirect('/')->with(['success' => 'You are now logged out!']);
    }

    public function index()
    {
        if (!Auth::check()) {
            return view('welcome');
        }

        $user = Auth::user();

        // Role-based Goal filtering
        if ($user->hasRole('admin')) {
            // Admin: see all goals
            $goals = Goal::with(['projectManager', 'assignedUsers', 'sdg'])
                ->latest()
                ->get();
        } elseif ($user->hasRole('project-manager')) {
            // Project Managers: see goals they manage
            $goals = Goal::with(['projectManager', 'assignedUsers', 'sdg'])
                ->where('project_manager_id', $user->id) // keep this if PMs are linked in goals
                ->latest()
                ->get();
        } elseif ($user->hasRole('staff')) {
            // Staff: see goals assigned to them (many-to-many)
            $goals = Goal::with(['projectManager', 'assignedUsers', 'sdg'])
                ->forStaff() // uses the Trait created
                ->latest()
                ->get();
        } else {
            $goals = collect(); // empty if no role match
        }

        // Dashboard statistics
        $sdgs = Sdg::all();
        $totalGoals = Goal::count();
        $compliantGoals = Goal::where('compliance_percentage', 100)->count();
        $nonCompliantGoals = Goal::where('compliance_percentage', '<', 100)->count();

        return view('goals.index', compact(
            'totalGoals',
            'compliantGoals',
            'nonCompliantGoals',
            'goals',
            'sdgs',
            'user'
        ));
    }
}
