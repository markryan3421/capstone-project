<?php

namespace App\Http\Controllers;

use App\Models\Sdg;
use App\Models\Goal;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(LoginRequest $request) {
        $credentials = $request->only('email', 'password');

        // Check if user exists
        if(Auth::attempt($credentials)) {
            // Store cookies
            $request->session()->regenerate();
            $user = Auth::user();

            $user->initializeCurrentSdg();

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
        $goals = Goal::getGoalsFor(Auth::user());

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
