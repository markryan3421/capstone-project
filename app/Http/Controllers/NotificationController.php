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
            'notifications' => Auth::user()->unreadNotifications->take(5)->map(function ($notif) {
                return [
                    'id' => $notif->id,
                    'title' => $notif->data['title'],
                    'message' => $notif->data['message'],
                    'url' => $notif->data['url'] ?? null,
                    'time' => $notif->created_at->diffForHumans(),
                ];
            }),
        ]);
    }

    public function markAsRead($id) {
        $notif = auth()->user()->unreadNotifications()->find($id);
        if ($notif) {
            $notif->markAsRead();
        }
        return response()->noContent();
    }
}
