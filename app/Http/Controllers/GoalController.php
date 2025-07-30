<?php

namespace App\Http\Controllers;

use App\Models\Sdg;
use App\Models\Goal;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Events\AssignToStaffEvent;
use Illuminate\Support\Facades\Auth;

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
     * Display a listing of the resource.
     */
    public function index(Goal $goal)
    {
        // Fetch all goals and its related projectManager, assignedUsers, and SDG (All relationship name from Goal model)
        $goals = Goal::with(['projectManager', 'assignedUsers', 'sdg'])->latest()->get();

        // (1)'tasks' model name, (2)'taskProductivities' relationship name from Task model, and (3)'user' relationship name from TaskProductivity model
        $goal = Goal::with(['tasks.taskProductivities.user'])->findOrFail($goal->id);

        // Return the index view and pass the $goals data
        return view('goals.index', compact('goals', 'goal'));
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
    public function store(Request $request)
    {

        $incomingFields = $request->validate([
            'project_manager_id' => 'required|exists:users,id',
            'sdg_id' => 'required|exists:sdgs,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type' => 'required|in:short,long',
            'assigned_users.*' => [
                'nullable',
                'exists:users,id',
                function ($attribute, $value, $fail) {
                    $user = User::find($value);
                    if (!$user) {
                        return $fail("Selected user does not exist.");
                    }
                    if ($user->id === Auth::id()) {
                        return $fail("You cannot assign a goal to yourself.");
                    }
                    if (!$user->hasRole('staff')) {
                        return $fail("Only users with the 'staff' role can be assigned.");
                    }
                }
            ],
        ]);

        $goal = Goal::create([
            'project_manager_id' => Auth::id(),
            'sdg_id' => $incomingFields['sdg_id'],
            'title' => $incomingFields['title'],
            'slug' => Str::slug($incomingFields['title']),
            'description' => $incomingFields['description'],
            'type' => $incomingFields['type'],
            'start_date' => $incomingFields['start_date'],
            'end_date' => $incomingFields['end_date'],
            'status' => 'pending',
        ]);

        // Check if there's user assigned
        if ($request->has('assigned_users')) {
            $goal->assignedUsers()->attach($request->assigned_users);
        
            // Loop through each assigned_users since we can assign one or more user
            foreach ($request->assigned_users as $userId) {
                // Trigger the event to assigned users where the message will be sent
                event(new AssignToStaffEvent('A new goal has been assigned to you.', $userId));
            }
        }
        
        return redirect('/')->with([
            'success' => "Goal '{$goal->title}' created successfully!"
        ]);
    }



    /**
     * Display the specified resource.
     */
    public function show(Goal $goal)
    {   
        // Fetch the goal by ID and load its related project manager, assigned users, and SDG
        $goal->load([
            'projectManager',
            'assignedUsers',
            'sdg',
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

        // Fetch all users/staffs assigned
        $staffUsers = User::where('id', '!=', Auth::id())
                            ->whereHas('roles', function($query) {
                                $query->where('name', 'staff');
                            })->get();

        return view('goals.edit', compact('goal', 'sdgs', 'staffUsers'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Goal $goal)
    {
        $incomingFields = $request->validate([
            'sdg_id' => 'required|exists:sdgs,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'type' => 'required|in:short,long',
            'status' => 'required|in:pending,in-progress,completed',
            'assigned_users.*' => [
                'nullable',
                'exists:users,id',
                function($attribute, $value, $fail) {
                    $user = User::find($value);
                    if (!$user) {
                        return $fail("Selected user does not exist.");
                    }
                    if ($user->id === Auth::id()) {
                        return $fail("You cannot assign a goal to yourself.");
                    }
                    if (!$user->hasRole('staff')) {
                        return $fail("Only users with the 'staff' role can be assigned.");
                    }
                }
            ],
        ]);

        // Find the goal
        $goal = Goal::findOrFail($goal->id);

        $goal->update([
            'sdg_id' => $incomingFields['sdg_id'],
            'title' => $incomingFields['title'],
            'slug' => Str::slug($incomingFields['title']),
            'description' => $incomingFields['description'],
            'type' => $incomingFields['type'],
            'start_date' => $incomingFields['start_date'],
            'end_date' => $incomingFields['end_date'],
            'status' => $incomingFields['status'],
        ]);

        // Sync the assignedUsers using many-to-many relationship
        $goal->assignedUsers()->sync($request->assigned_users);

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
