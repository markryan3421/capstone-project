<?php

namespace App\Models;

use App\Models\Goal;
use App\Traits\FilterBySdg;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory, FilterBySdg;

    protected $fillable = [
        'goal_id',
        'title',
        'slug',
        'description',
        'status',
    ];

    public function goal(): BelongsTo {
        return $this->belongsTo(Goal::class);
    }
}
