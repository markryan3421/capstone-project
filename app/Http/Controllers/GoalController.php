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
    public function store(Request $request)
    {
        $incomingFields = $request->validate([
            'project_manager_id' => 'required|exists:users,id',
            'sdg_id' => 'required|exists:sdgs,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date'         => ['required', 'date', 'after_or_equal:today'],
            'end_date'           => [
                'required',
                'date',
                'after_or_equal:start_date',
            ],
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

        // Create the goal
        $goal = Goal::create([
            'project_manager_id' => Auth::id(),
            'sdg_id' => $incomingFields['sdg_id'],
            'title' => $incomingFields['title'],
            'slug' => Str::slug($incomingFields['title']),
            'description' => $incomingFields['description'],
            'type' => $incomingFields['type'],
            'start_date' => Carbon::parse($incomingFields['start_date'])->startOfDay(),
            'end_date' => Carbon::parse($incomingFields['end_date'])->endOfDay(),
            'status' => 'pending',
        ]);

        $goal->load('projectManager');
        $sender = Auth::user();

        // Assign staff and notify
        if ($request->has('assigned_users')) {
            $goal->assignedUsers()->attach($request->assigned_users);

            foreach ($request->assigned_users as $userId) {
                $user = User::find($userId);

                $user->notify(new TaskStatusNotification(
                    "{$sender->name} assigned a new goal.",
                    $goal->title,
                    route('goals.show', ['goal' => $goal->slug]),
                    $goal->id,
                    $sender,
                    $goal,
                ));
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
        $user = Auth::user();

        // if(!$goal->assignedUsers->contains($user->id) || $user->hasRole('admin')) {
        //     abort(403, 'Unauthorized action.');
        // }

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

        $goal->load('projectManager');
        $sender = Auth::user();

        // Assign staff and notify
        if ($request->has('assigned_users')) {
            $goal->assignedUsers()->sync($request->assigned_users);

            foreach ($request->assigned_users as $userId) {
                $user = User::find($userId);

                $user->notify(new TaskStatusNotification(
                    "{$sender->name} made some changes to a goal.",
                    "Go check it out.",
                    route('goals.show', ['goal' => $goal->slug]),
                    $goal->id,
                    $sender,
                    $goal,
                ));
            }
        }

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
