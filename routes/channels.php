<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// // Define a private channel for broadcasting events
// // This channel will be used to send messages to specific users
// Broadcast::channel('private-chat.{userId}', function($user, $userId) {
//     // Check if the authenticated user's ID matches the userId parameter and if it exist
//     // This ensures that only the intended user can receive messages on this channel
//     return (int) $user->id === (int) $userId;
// });
