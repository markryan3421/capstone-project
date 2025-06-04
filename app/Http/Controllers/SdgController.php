<?php

namespace App\Http\Controllers;

use App\Models\Sdg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
