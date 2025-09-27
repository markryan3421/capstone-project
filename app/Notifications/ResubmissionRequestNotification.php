<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResubmissionRequestNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $taskId;
    public $taskTitle;
    public $staffId;
    public $staffName;
    public $status;
    public $message;

    public function __construct($taskId, $taskTitle, $staffId, $staffName, $status, $message)
    {
        $this->taskId = $taskId;
        $this->taskTitle = $taskTitle;
        $this->staffId = $staffId;
        $this->staffName = $staffName;
        $this->status = $status;
        $this->message = $message;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    public function toDatabase()
    {
        return [
            'task_id' => $this->taskId,
            'task_title' => $this->taskTitle,
            'staff_id' => $this->staffId,
            'staff_name' => $this->staffName,
            'status' => $this->status,
            'message' => $this->message,
            'time' => now()->toDateTimeString(),
        ];
    }

    public function toBroadcast()
    {
        return [
            'task_id' => $this->taskId,
            'task_title' => $this->taskTitle,
            'staff_id' => $this->staffId,
            'staff_name' => $this->staffName,
            'status' => $this->status,
            'message' => $this->message,
            'time' => now()->toDateTimeString(),
        ];
    }
}
