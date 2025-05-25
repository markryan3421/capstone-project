<?php

namespace App\Models;

use App\Models\Sdg;
use App\Models\Goal;
use App\Traits\FilterBySdg;
use App\Models\TaskProductivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory, FilterBySdg;

    protected $fillable = [
        'goal_id',
        'sdg_id',
        'title',
        'slug',
        'description',
        'status',
        'remarks',
        'deadline',
    ];
    
    protected $casts = [
        'deadline' => 'date',
    ];

    public function goal(): BelongsTo {
        return $this->belongsTo(Goal::class);
    }

    public function sdg(): BelongsTo {
        return $this->belongsTo(Sdg::class);
    }

    public function taskProductivities(): HasMany {
        return $this->hasMany(TaskProductivity::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
