<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index() {
        return view('settings.index');
    }

    public function users() {
        return view('settings.users.index');
    }

    public function roles() {
        return view('settings.roles.index');
    }
}
