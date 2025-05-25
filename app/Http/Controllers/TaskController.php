<?php

namespace App\Http\Controllers;

use App\Models\Goal;
use App\Models\Task;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\GoalProgressUpdater;

class TaskController extends Controller
{
    use GoalProgressUpdater;

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
    public function store(Request $request, Goal $goal)
    {
        $incomingFields = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:pending,in-progress,completed',
            'deadline' => 'required|date|after_or_equal:today',
        ]);

        $task = $goal->tasks()->create([
            'goal_id' => $goal->id,
            'sdg_id' => $goal->sdg_id,
            'slug' => Str::slug($incomingFields['title']),
            'title' => $incomingFields['title'],
            'description' => $incomingFields['description'],
            'status' => $incomingFields['status'],
            'deadline' => $incomingFields['deadline'],
        ]);

        $goal = $task->goal;
        $this->updateGoalProgress($goal);

        return back()->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Goal $goal, Task $task)
    {
        // dd($task->deadline);
        return view('tasks.edit', compact('goal','task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Goal $goal, Task $task)
    {
        $incomingFields = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'status' => 'required|in:pending,in-progress,completed',
            'deadline' => 'required|date|after_or_equal:today',
        ]);

        $task->update([
            'goal_id' => $goal->id,
            'sdg_id' => $goal->sdg_id,
            'title' => $incomingFields['title'],
            'slug' => Str::slug($incomingFields['title']),
            'description' => $incomingFields['description'],
            'status' => $incomingFields['status'],
            'deadline' => $incomingFields['deadline'],
        ]);

        $goal = $task->goal;
        $this->updateGoalProgress($goal);

        return redirect("/goals/show/{$goal->slug}")->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        //
    }
}
