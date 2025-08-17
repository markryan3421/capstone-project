<?php

namespace App\Models;

use App\Models\Sdg;
use App\Models\Task;
use App\Models\User;
use App\Traits\FilterBySdg;
use Illuminate\Support\Str;
use App\Traits\HasGoalNotifications;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TaskStatusNotification;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Goal extends Model
{
    use HasFactory, FilterBySdg, HasGoalNotifications;

    protected $fillable = [
        'project_manager_id',
        'sdg_id',
        'title',
        'slug',
        'type', // 'short' or 'long'
        'compliance_percentage',
        'description',
        'start_date',
        'end_date',
        'status', 
    ];

    protected $casts = [
        'compliance_percentage' => 'decimal:2',
    ];

    protected $attributes = [
        'compliance_percentage' => 0,
    ];

    public function sdg(): BelongsTo {
        return $this->belongsTo(Sdg::class);
    }

    public function projectManager(): BelongsTo {
        return $this->belongsTo(User::class, 'project_manager_id');
    }

    public function assignedUsers() {
        return $this->belongsToMany(User::class, 'goal_user', 'goal_id', 'user_id')
            ->withTimestamps();
    }


    public function tasks() {
        return $this->hasMany(Task::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
