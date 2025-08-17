<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function unreadCount() {
        return ['count' => Auth::user()->unreadNotifications->count()];
    }

    public function unreadNotif() {
        return response()->json([
            'notifications' => Auth::user()->unreadNotifications->map(function ($notif) {
                return [
                    'id' => $notif->id,
                    'icon' => $notif->data['icon'] ?? asset('storage/avatars/default.png'),
                    'title' => $notif->data['title'],
                    'message' => $notif->data['message'],
                    'url' => $notif->data['url'] ?? null,
                    'time' => $notif->created_at->diffForHumans(),
                    'sender_name' => $notif->data['sender_name'] ?? '',
                    'read_at' => $notif->read_at,
                ];
            }),
        ]);
    }

    public function markAsRead($id) {
        $notif = Auth::user()->unreadNotifications()->find($id);
        if ($notif) {
            $notif->markAsRead();
        }
        return response()->noContent();
    }
}
