<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Goal;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TaskProductivity;
use App\Models\ResubmissionRequest;
use App\Traits\GoalProgressUpdater;
use Illuminate\Support\Facades\Auth;
use App\Notifications\TaskStatusNotification;
use App\Notifications\ResubmissionRequestNotification;

class TaskProductivityController extends Controller
{
    use GoalProgressUpdater;

    // Approve late resubmission
    public function lateResubmission(Request $request, TaskProductivity $productivity) {
        $goal = $productivity->task->goal;

        // Validate incoming request
        $request->validate([
            'subject' => 'required|string|max:255',
            'comments' => 'nullable|string',
            'file' => 'nullable|file|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx|max:20480',
        ]);

        // Handle file upload if exists
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

        $now = now();

        // Use updateOrCreate (either create new OR update existing)
        $productivity = TaskProductivity::updateOrCreate(
            [
                // Unique condition: only one record per user per task
                'task_id' => $productivity->task->id,
                'user_id' => Auth::id(),
            ],
            array_merge([
                'sdg_id' => $productivity->task->sdg_id,
                'goal_id' => $productivity->task->goal_id,
                'subject' => $request->subject,
                'comments' => $request->comments,
                'date' => $now->toDateString(),
                'status' => 'pending',
                'remarks' => 'Pending for review',
            ], $fileData)
        );

        // Update goal progress
        $this->updateGoalProgress($goal);

        // Notify project manager
        $goal->load('projectManager');
        $sender = Auth::user();

        if ($goal->projectManager) {
            $action = $productivity->wasRecentlyCreated ? 'submitted' : 'resubmitted';

            $goal->projectManager->notify(new TaskStatusNotification(
                "{$sender->name} {$action} a task for {$goal->title}.",
                "Go check it out.",
                route('goals.show', ['goal' => $goal->slug]),
                $goal->id,
                $sender,
                $goal
            ));
        }

        return redirect('/')->with('success', 'Task submitted successfully.');
    }

    public function lateSubmissionForm(Task $task) {

        return view('tasks.late-submission-form', compact('task'));
    }

    // reject resubmission request
    public function rejectResubmissionRequest(Task $task) {
        $task->status = 'rejected_resubmission';
        $task->save();

        // 
        $goal = $task->goal;

        // Notify the user about the approval
        $admin = Auth::user();
        $assignedUsers = $goal->assignedUsers;
        // dd($assignedUsers);

        foreach($assignedUsers as $staff) {
            $staff->notify(new TaskStatusNotification(
                'Rejected resubmission.',
                'Your resubmission request has been rejected by ' . $admin->name . '. You can no longer submit a file in this task.',
                route('goals.show', ['goal' => $goal->slug]),
                $goal->id,
                $admin, 
                $goal
            ));
        }

        return back()->with('success', 'Resubmission rejected successfully.');
    }

    // approve resubmission request
    public function approveResubmissionRequest(Task $task) {
        // Update the task status to 'approved'
        $task->status = 'approved_resubmission';
        $task->save();

        $goal = $task->goal;

        // Notify the user about the approval
        $admin = Auth::user();
        $assignedUsers = $goal->assignedUsers;
        // dd($assignedUsers);

        foreach($assignedUsers as $staff) {
            $staff->notify(new TaskStatusNotification(
                'Approved resubmission.',
                'Your resubmission request has been approved by ' . $admin->name . '. You can now submit a file in this task.',
                route('goals.show', ['goal' => $goal->slug]),
                $goal->id,
                $admin, 
                $goal
            ));
        }

        return back()->with('success', 'Resubmission approved successfully.');
    }

    public function requestResubmission(Request $request, Task $task) {
        $task->update(['status' => 'resubmission_requested']);

        $goal = $task->goal;

        // Send notification
        $goal->load('projectManager');
        $sender = Auth::user(); // The staff submitting that task

        // Check if the project manager exists
        if($goal->projectManager) {
            $goal->projectManager->notify(new TaskStatusNotification(
                "{$sender->name} requested a resubmission for {$goal->title}.",
                "Go check it out.",
                route('goals.show', ['goal' => $goal->slug]),
                $goal->id,
                $sender,
                $goal
            ));
        }

        return back()->with('success', 'Resubmission request sent successfully.');
    }

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

        $goal = $productivity->task->goal;
        // Send notification
        $goal->load('projectManager');
        $sender = Auth::user(); // The staff submitting that task

        // Check if the project manager exists
        if($goal->projectManager) {
            $goal->projectManager->notify(new TaskStatusNotification(
                "{$sender->name} resubmitted a task for {$goal->task->title}.",
                "Go check it out.",
                route('goals.show', ['goal' => $goal->slug]),
                $goal->id,
                $sender,
                $goal
            ));
        }

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
     * Show Submit task form
     */
    public function create(Task $task)
    {
        return view('tasks.submit-task', compact('task'));
    }

    /**
     * Submit task
     */
    public function submit(Request $request, Task $task)
    {
        $goal = $task->goal;

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
