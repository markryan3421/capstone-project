<?php

namespace App\Models;

use App\Models\Sdg;
use App\Models\User;
use App\Traits\FilterBySdg;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskProductivity extends Model
{
    use HasFactory, FilterBySdg;
    
    protected $fillable = [
        'sdg_id',
        'goal_id',
        'task_id',
        'user_id',
        'subject',
        'comments',
        'date',
        // 'start_time',
        // 'end_time',
        // 'time_rendered',
        'file_name',
        'file_size',
        'file_type',
        'file_path',
        'status',
        'remarks',
    ];

    public function sdg(): BelongsTo {
        return $this->belongsTo(Sdg::class);
    }

    public function goal(): BelongsTo {
        return $this->belongsTo(Goal::class);
    }

    public function task(): BelongsTo {
        return $this->belongsTo(Task::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
