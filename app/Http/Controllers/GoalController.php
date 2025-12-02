<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sdg;
use App\Models\Goal;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreGoalRequest;
use App\Http\Requests\UpdateGoalRequest;
use App\Notifications\TaskStatusNotification;

class GoalController extends Controller
{
    public function nonComplianceReport() {
        $nonCompliantGoals = Goal::where('compliance_percentage', '<', 100)
            ->with(['projectManager', 'assignedUsers', 'sdg'])
            ->latest()
            ->get();

        return view('reports.non-compliance', compact('nonCompliantGoals'));
    }

    public function complianceReport() {
        $compliantGoals = Goal::where('compliance_percentage', 100)
            ->with(['projectManager', 'assignedUsers', 'sdg'])
            ->latest()
            ->get();

        return view('reports.compliance', compact('compliantGoals'));
    }

    public function viewShortTermGoals() {
        $shortTermGoals = Goal::where('type', 'short')
            ->with(['projectManager', 'assignedUsers', 'sdg'])
            ->latest()
            ->get();

        return view('goals.short-term', compact('shortTermGoals'));
    }

    public function viewLongTermGoals() {
        $longTermGoals = Goal::where('type', 'long')
            ->with(['projectManager', 'assignedUsers', 'sdg'])
            ->latest()
            ->get();

        return view('goals.long-term', compact('longTermGoals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sdgs = Sdg::all();
        $user = Auth::user();

        // Fetch the SDG based on the user's current_sdg_id
        $sdg = Sdg::find($user->current_sdg_id);

        // Fetch users assigned to the same SDG (e.g., other staff)
        $staffUsers = User::where('current_sdg_id', '=', $user->current_sdg_id)
            ->where('id', '!=', Auth::id()) // Exclude the current user
            ->role('staff')
            ->get();

        return view('goals.create', compact('sdgs', 'sdg', 'staffUsers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGoalRequest $request)
    {
        $goal = Goal::createGoalWithAssignments($request->validated(), Auth::user());
        // the "createGoalWithAssignments" is from Goal model
        // the "StoreGoalRequest" is from the Requests folder, the one that handles the validation

        return redirect('/')->with([
            'success' => "Goal '{$goal->title}' created successfully!"
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(Goal $goal)
    {
        $user = Auth::user();

        // if(!$goal->assignedUsers->contains($user->id) || $user->hasRole('admin')) {
        //     abort(403, 'Unauthorized action.');
        // }

        // Fetch the goal by ID and load its related project manager, assigned users, and SDG
        $goal->load([
            'projectManager:id,name,avatar',
            'assignedUsers:id,name,email,avatar',
            'sdg:id,name',
            'tasks.taskProductivities.user', // Load the user for each task's taskProductivity
        ]);

        return view('goals.show', compact('goal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Goal $goal)
    {
        // Find the goal to edit
        $goal = Goal::with('assignedUsers')->findOrFail($goal->id);

        // Fetch all Sdg
        $sdgs = Sdg::all();
        $user = Auth::user();

        // Fetch all users/staffs assigned
        $staffUsers = User::where('current_sdg_id', '=', $user->current_sdg_id)
                            ->where('id', '!=', Auth::id())
                            ->role('staff')
                            ->get();

        return view('goals.edit', compact('goal', 'sdgs', 'staffUsers'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGoalRequest $request, Goal $goal)
    {
        $goal = Goal::updateGoalWithAssignments($request->validated(), $goal, Auth::user());

        return redirect('/')->with('success', "Goal '{$goal->title}' updated successfully!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Goal $goal)
    {
        // Find the goal
        $goal = Goal::findOrFail($goal->id);

        // Delete the goal
        $goal->delete();

        return redirect('/')->with('success', "Goal '{$goal->title}' deleted successfully!");
    }
}
