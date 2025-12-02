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
use Illuminate\Support\Facades\Auth;
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

    public static function forStaff() {
        $userId = Auth::id();
        return static::whereHas('assignedUsers', function($query) use ($userId) {
            $query->where('user_id', $userId);
        });
    }

    public static function getGoalsFor(User $user) {
        if($user->hasRole('admin')) {
            return static::latest()->get();
        }

        if($user->hasRole('project-manager')) {
            return static::where('project_manager_id', '=', $user->id)->latest()->get();
        }

        if($user->hasRole('staff')) {
            return static::forStaff()->latest()->get();
        }

    }

    public static function updateGoalWithAssignments(array $data, Goal $goal, User $updater) {
        $goal = Goal::findOrFail($goal->id);

        $goal->update([
            'sdg_id' => $data['sdg_id'],
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'description' => $data['description'],
            'type' => $data['type'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'status' => $data['status'],
        ]);

        // Sync assigned users and notify them
        if(!empty($data['assigned_users'])) {
            $goal->assignedUsers()->sync($data['assigned_users']);

            foreach($data['assigned_users'] as $userId) {
                $user = User::find($userId);

                $user->notify(new TaskStatusNotification(
                    "{$updater->name} updated a goal assigned to you.",
                    $goal->title,
                    route('goals.show', ['goal' => $goal->slug]),
                    $goal->id,
                    $updater,
                    $goal,
                ));
            }
        }
        return $goal;
    }

    // This function is for storing the goal attributes to the database
    public static function createGoalWithAssignments(array $data, User $creator) {
        $goal = static::create([
            'project_manager_id' => Auth::id(),
            'sdg_id' => $data['sdg_id'],
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'description' => $data['description'],
            'type' => $data['type'],
            'start_date' => Carbon::parse($data['start_date'])->now(),
            'end_date' => Carbon::parse($data['end_date'])->endOfDay(),
            'status' => 'pending',
        ]);

        // Assign Users and notify them
        if(!empty($data['assigned_users'])) {
            $goal->assignedUsers()->attach($data['assigned_users']);

            foreach($data['assigned_users'] as $userId) {
                $user = User::find($userId);

                $user->notify(new TaskStatusNotification(
                    "{$creator->name} assigned a new goal to you.",
                    $goal->title,
                    route('goals.show', ['goal' => $goal->slug]),
                    $goal->id,
                    $creator,
                    $goal,
                ));
            }
        }

        return $goal;
    }

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
