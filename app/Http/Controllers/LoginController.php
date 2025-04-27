<?php

namespace App\Http\Controllers;

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
            // event(new ExampleEvent(['username' => Auth::user()->username, 'action' => 'logged in']));

            // Redirect back to homepage
            return redirect('/')->with(['success' => 'You are now logged in!']);
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
            return view('homepage')->with(['user' => Auth::user()]);
        } else {
            return view('welcome');
        }
    }
}
