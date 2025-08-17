<?php

namespace App\Notifications;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TaskStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public $title;
    public $message;
    public $url;
    public $goalId;
    public $sender;
    public $goal;

    public function __construct($title, $message, $url, $goalId, User $sender, Goal $goal)
    {
        $this->title = $title;
        $this->message = $message;
        $this->url = $url;
        $this->goalId = $goalId;
        $this->sender = $sender;
        $this->goal = $goal;
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

    // This function will be used to format the notification data for the database channel
    public function toDatabase($notifiable): array
    {

        return [
            'title' => $this->title,
            'message' => $this->message,
            'url' => $this->url,
            'time' => now()->toDateTimeString(),
            'goal_id' => $this->goalId, 
            'icon' => $this->sender && $this->sender->avatar
                    ? asset('storage/avatars/' . $this->sender->avatar)
                    : null,
            'sender_name' => $this->sender->name,
        ];
    }

    public function toBroadcast($notifiable): array
    {

        return [
            'icon' => $this->sender && $this->sender->avatar
                ? asset('storage/avatars/' . $this->sender->avatar)
                : null,
            'title' => $this->title,
            'message' => $this->message,
            'url' => $this->url,
            'time' => now()->toDateTimeString(),
            'sender_name' => $this->sender->name,
            'unread_count' => $notifiable->unreadNotifications->count(),
        ];
    }

    public function toArray($notifiable)
    {
        return [
            'icon' => $this->sender && $this->sender->avatar
                ? asset('storage/avatars/' . $this->sender->avatar)
                : asset('storage/avatars/default.png'),
            'title' => $this->title,
            'message' => $this->message,
            'url' => $this->url,
            'sender_name' => $this->sender->name,
        ];
    }

}
