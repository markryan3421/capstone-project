<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\TaskProductivity;
use Illuminate\Support\Facades\Auth;

class TaskProductivityController extends Controller
{
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
    public function create(Task $task)
    {
        return view('tasks.submit-task', compact('task'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Task $task)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'comments' => 'nullable|string',
            'file' => 'nullable|file|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx|max:20480',
        ]);

        $fileData = [];
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filePath = $file->store('task_files', 'public');

            $fileData = [
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'file_type' => $file->getClientMimeType(),
                'file_path' => $filePath,
            ];
        }

        $now = Carbon::now();
        // $start = Carbon::createFromTimeString($task->start_time);
        // $end = Carbon::createFromTimeString($task->end_time);
        // $duration = $end->diffInMinutes($start);

        TaskProductivity::create(array_merge([
            'sdg_id' => $task->sdg_id,
            'goal_id' => $task->goal_id,
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'subject' => $request->subject,
            'comments' => $request->comments,
            'date' => $now->toDateString(),
            // 'start_time' => $start->format('H:i:s'),
            // 'end_time' => $end->format('H:i:s'),
            // 'time_rendered' => $duration,
            'status' => 'pending',
            'remarks' => 'Pending for review',
        ], $fileData));

        return redirect('/')->with('success', 'Task submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(TaskProductivity $taskProductivity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TaskProductivity $taskProductivity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TaskProductivity $taskProductivity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TaskProductivity $taskProductivity)
    {
        //
    }
}
