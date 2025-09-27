<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Sdg;
use App\Models\Task;
use App\Models\User;
use App\Traits\FilterBySdg;
use Illuminate\Support\Str;
use App\Traits\FilterGoalByStaff;
use App\Models\ResubmissionRequest;
use App\Traits\HasGoalNotifications;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TaskStatusNotification;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Goal extends Model
{
    use HasFactory, FilterBySdg, HasGoalNotifications, FilterGoalByStaff;

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
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'compliance_percentage' => 'decimal:2',
    ];

    // This model ensures the end_date is set to the end of the day (11:59:59 PM)
    public function setEndDateAttribute($value)
    {
        $this->attributes['end_date'] = Carbon::parse($value)->endOfDay();
    }

    public function setStartDateAttribute($value)
    {
        $this->attributes['start_date'] = Carbon::parse($value)->now();
    }

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
