<?php

namespace App\Traits;

use Illuminate\Support\Facades\DB;
use App\Notifications\TaskStatusNotification;

trait HasGoalNotifications
{
    protected static function bootHasGoalNotifications()
    {
        static::deleting(function ($model) {
            DB::table('notifications')
                ->where('type', TaskStatusNotification::class)
                ->where('data->goal_id', $model->id)
                ->delete();
        });
    }
}
