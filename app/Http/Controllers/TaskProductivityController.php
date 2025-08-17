<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Goal;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\TaskProductivity;
use App\Traits\GoalProgressUpdater;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TaskStatusNotification;

class TaskProductivityController extends Controller
{
    use GoalProgressUpdater;

    public function resubmit(Request $request, TaskProductivity $productivity) {
        // Validate incoming data from the resubmit form
        $request->validate([
            'subject' => 'required|string|max:255',
            'comments' => 'nullable|string',
            'file' => 'nullable|file|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx|max:20480',
        ]);

        // Prepare file data if a new file is uploaded
        $fileData = [];
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Store file in 'public/task_files' and get the path
            $filePath = $file->store('task_files', 'public');

            // Save file details for updating
            $fileData = [
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'file_type' => $file->getClientMimeType(),
                'file_path' => $filePath,
            ];
        }

        // Update the task productivity record
        $productivity->update(array_merge([
            'subject' => $request->subject,
            'comments' => $request->comments,
            'status' => 'pending',             // Reset the status
            'remarks' => 'Pending for review', // Clear the previous rejection remarks
            'date' => now()->toDateString(),   // Update the date of resubmission
        ], $fileData));                        // Merge file data if any

        // Update goal progress after resubmission
        $this->updateGoalProgress($productivity->task->goal);

        return redirect('/')->with('success', 'Task submitted successfully.');
    }

    public function resubmitForm($id) {
        $productivity = TaskProductivity::findOrFail($id);

        return view('tasks.resubmit-task', compact('productivity'));
    }

    public function reject(Request $request, TaskProductivity $submission) {

        $request->validate([
            'remarks' => 'required|string|max:1000',
        ]);

        $productivity = TaskProductivity::findOrFail($submission->id);

        $productivity->status = 'rejected';
        $productivity->remarks = $request->remarks . ' - Rejected by ' . Auth::user()->name;
        $productivity->save();

        // Update parent task and goal
        $task = $productivity->task;
        $goal = $task->goal;

        $this->updateGoalProgress($goal);

        // Notify the user about the rejection
        $admin = Auth::user();
        $staff = $submission->user;

        $staff->notify(new TaskStatusNotification(
            "{$admin->name} rejected your task submission for {$task->title}.",
            "Task rejected: {$request->remarks}",
            route('goals.show', ['goal' => $submission->task->goal->slug]),
            $submission->task->id,
            $admin,
            $submission->task->goal,
        ));

        return redirect()->back()->with('success', 'Task submission rejected with remarks');
    }

    public function approve(TaskProductivity $submission) {
        $submission->status = 'approved';
        $submission->remarks = 'Approved by ' . Auth::user()->name;

        $submission->save();

        $this->updateGoalProgress($submission->task->goal);

        // Notify the user about the approval
        $admin = Auth::user(); // The one who approved the task
        $staff = $submission->user; // The staff whose task was approved

        $staff->notify(new TaskStatusNotification(
            "{$admin->name} approved your task submission for {$submission->task->title}.",
            "Congratulations! Your task has been approved.",
            route('goals.show', ['goal' => $submission->task->goal->slug]),
            $submission->task->id,
            $admin,
            $submission->task->goal,
        ));

        return back()->with('success', 'Task approved successfully.');
    }

    /**
     * Show the form for submitting the task
     */
    public function create(Task $task)
    {
        return view('tasks.submit-task', compact('task'));
    }

    /**
     * Submit a task assigned
     */
    public function submit(Request $request, Task $task)
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

        $goal = $task->goal;
        $this->updateGoalProgress($goal);

        // Send notification
        $goal->load('projectManager');
        $sender = Auth::user(); // The staff submitting that task

        // Check if the project manager exists
        if($goal->projectManager) {
            $goal->projectManager->notify(new TaskStatusNotification(
                "{$sender->name} submitted a task for {$goal->title}.",
                "Go check it out.",
                route('goals.show', ['goal' => $goal->slug]),
                $goal->id,
                $sender,
                $goal
            ));
        }

        return redirect('/')->with('success', 'Task submitted successfully.');
    }
    
}
