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
use Illuminate\Support\Facades\Storage;
use App\Notifications\TaskStatusNotification;
use App\Notifications\ResubmissionRequestNotification;

class TaskProductivityController extends Controller
{
    use GoalProgressUpdater;

    public function rejectForm($id) {
        $submission = TaskProductivity::findOrFail($id);

        return view('tasks.reject-submission-form', compact('submission'));
    }

    // Approved late resubmission
    public function lateResubmission(Request $request, Task $task) {
        $goal = $task->goal;

        // (1) For the task itself
        $incomingFields = $request->validate([
            'subject' => 'required|string|max:255',
            'comments' => 'nullable|string',
            'files' => 'required',
            'files.*' => 'file|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx|max:20480',
        ]);

        // (2) For the files being submitted
        $taskProductivity = TaskProductivity::updateOrCreate(
            [
                'task_id' => $task->id,
                'user_id' => Auth::id(),
                'updated_at' => now()->toDateString(),
            ],
            [
                'sdg_id' => $task->sdg_id,
                'goal_id' => $task->goal_id,
                'subject' => $incomingFields['subject'],
                'comments' => $incomingFields['comments'],
                'status' => 'pending',
                'remarks' => 'Pending for review',
                'date' => now()->toDateString(),
            ]
        );

        foreach($incomingFields['files'] as $file) {
            $filePath = $file->store('task_productivities', 'public');

            $taskProductivity->taskProductivityFiles()->updateOrCreate([
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'file_type' => $file->getClientMimeType(),
                'file_path' => $filePath,
            ]);
        }

        // Update goal progress
        // $this->updateGoalProgress($productivity->task->goal);

        // Notify project manager
        $goal->load('projectManager');
        $sender = Auth::user();

        if ($goal->projectManager) {
            $action = $task->wasRecentlyCreated ? 'submitted' : 'resubmitted';

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
    public function approveResubmissionRequest(Request $request, Task $task) {
        $incomingFields = $request->validate([
            'deadline' => 'required|date|after_or_equal:today',
        ]);

        // update the deadline
        $task->update([
            'deadline' => $incomingFields['deadline'],
        ]);

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

    public function resubmitForm(Task $task, $id) {
        $productivity = TaskProductivity::findOrFail($id);
        $submission = $productivity;

        return view('tasks.resubmit-task', compact('productivity', 'task', 'submission'));
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

    public function resubmit(Request $request, Task $task, TaskProductivity $productivity) {
        // Validate incoming data from the resubmit form
        $incomingFields = $request->validate([
            'subject' => 'required|string|max:255',
            'comments' => 'nullable|string',
            'files' => 'required',
            'files.*' => 'file|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx|max:20480',
        ]);

        // Find existing productivity
        $pastSubmissions = TaskProductivity::where('task_id', '=', $task->id)->first();

        // If exists, delete that productivity
        if($pastSubmissions) {
            foreach($pastSubmissions->taskProductivityFiles as $file) {
                // delete the files
                Storage::disk('public')->delete($file->file_path);
            }
            // delete DB records
            $pastSubmissions->taskProductivityFiles()->delete();
            $pastSubmissions->delete();
        }

        $updatedSubmission = TaskProductivity::create([
                'task_id' => $task->id,
                'user_id' => Auth::id(),
                'updated_at' => now()->toDateString(),
                'sdg_id' => $task->sdg_id,
                'goal_id' => $task->goal_id,
                'subject' => $incomingFields['subject'],
                'comments' => $incomingFields['comments'],
                'status' => 'pending',
                'remarks' => 'Pending for review',
                'date' => now()->toDateString(),
            ]);

        // upload and save the new files
        foreach($incomingFields['files'] as $file) {
            $filePath = $file->store('task_productivities', 'public');

            $updatedSubmission->taskProductivityFiles()->create([
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'file_type' => $file->getClientMimeType(),
                'file_path' => $filePath,
            ]);
        }

        // Update goal progress after resubmission
        $this->updateGoalProgress($updatedSubmission->task->goal);

        $goal = $task->goal;
        // Send notification
        $goal->load('projectManager');
        $sender = Auth::user(); // The staff submitting that task

        // Check if the project manager exists
        if($goal->projectManager) {
            $goal->projectManager->notify(new TaskStatusNotification(
                "{$sender->name} resubmitted a task for {$task->title}.",
                "Go check it out.",
                route('goals.show', ['goal' => $goal->slug]),
                $goal->id,
                $sender,
                $goal
            ));
        }

        return redirect("/goals/show/$goal->slug")->with('success', 'Task submitted successfully.');
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
            'files' => 'required',
            'files.*' => 'file|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx|max:20480',
        ]);

        // ✅ Check if a productivity record already exists for this user & task today
        $taskProductivity = TaskProductivity::firstOrCreate(
            [
                'task_id' => $task->id,
                'user_id' => Auth::id(),
                'date' => now()->toDateString(),
            ],
            [
                'sdg_id' => $task->sdg_id,
                'goal_id' => $task->goal_id,
                'subject' => $request->subject,
                'comments' => $request->comments,
                'status' => 'pending',
                'remarks' => 'Pending for review',
            ]
        );

        // ✅ Attach multiple uploaded files
        foreach ($request->file('files') as $file) {
            $filePath = $file->store('task_productivities', 'public');

            $taskProductivity->taskProductivityFiles()->create([
                'file_name' => $file->getClientOriginalName(),
                'file_size' => $file->getSize(),
                'file_type' => $file->getClientMimeType(),
                'file_path' => $filePath,
            ]);
        }

        // ✅ Update progress and notify project manager
        $this->updateGoalProgress($goal);
        $goal->load('projectManager');
        $sender = Auth::user();

        if ($goal->projectManager) {
            $goal->projectManager->notify(new TaskStatusNotification(
                "{$sender->name} submitted a task for {$goal->title}.",
                "Go check it out.",
                route('goals.show', ['goal' => $goal->slug]),
                $goal->id,
                $sender,
                $goal
            ));
        }

        return redirect('/')
            ->with('success', 'Task submitted successfully.');
    }
}
