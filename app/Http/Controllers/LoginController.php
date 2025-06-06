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
            return redirect('/')->with(['failure' => 'Invalid credentials']);
        }
    }

    public function logout() {
        // event(new ExampleEvent(['username' => Auth::user()->username, 'action' => 'logged out']));
        Auth::logout(); // log the user out
        return redirect('/')->with(['success' => 'You are now logged out!']);
    }

    public function index() {
        if(Auth::check()) {
            $sdgs = Sdg::all();

            // General statistics for dashboard/chart/report
            $totalGoals = Goal::count();
            $compliantGoals = Goal::where('compliance_percentage', 100)->count();
            $nonCompliantGoals = Goal::where('compliance_percentage', '<', 100)->count();

            // Fetch all goals with related projectManager, assignedUsers, and SDG (All relationship name from Goal model)
            $goals = Goal::with(['projectManager', 'assignedUsers', 'sdg'])->latest()->get();

            return view('goals.index', compact('totalGoals', 'compliantGoals', 'nonCompliantGoals'))->with(['user' => Auth::user(), 'sdgs' => $sdgs, 'goals' => $goals]);
        } else {
            return view('welcome');
        }
    }
}
