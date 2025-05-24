<?php

namespace App\Http\Controllers;

use App\Models\Sdg;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SdgController extends Controller
{
    public function changeSdg($tenantID) {
        // Check Tenant
        $tenant = Auth::user()->sdgs()->findOrFail($tenantID);

        // Change Tenant
        Auth::user()->update(['current_sdg_id' => $tenant->id]);

        // Update Tenant in Session
        session(['sdg_id' => $tenant->id]);

        // Redirect
        return redirect('/')->with(['success' => 'Tenant changed successfully!']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Sdg $sdg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sdg $sdg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sdg $sdg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sdg $sdg)
    {
        //
    }
}
