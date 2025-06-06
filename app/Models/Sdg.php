<?php

namespace App\Models;

use App\Models\Goal;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sdg extends Model
{
    use HasFactory;

    protected $fillable = [
        'cover_photo',
        'name',
        'slug',
    ];

    public function goals(): HasMany
    {
        return $this->hasMany(Goal::class);
    }

    // public function users(): HasMany
    // {
    //     return $this->hasMany(User::class);
    // }

    public function users(): BelongsToMany {
        return $this->belongsToMany(User::class, 'sdg_user', 'sdg_id', 'user_id')
            ->withTimestamps();
    }
}
