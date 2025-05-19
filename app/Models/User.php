<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Sdg;
use App\Models\Goal;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'current_sdg_id',
        'email',
        'user_slug',
        'password',
    ];

    // public function sdg() {
    //     return $this->belongsTo(Sdg::class);
    // }

    public function sdgs(): BelongsToMany
    {
        return $this->belongsToMany(Sdg::class, 'sdg_user', 'user_id', 'sdg_id')
            ->withTimestamps();
    }

    public function goalsAsManager() {
        return $this->hasMany(Goal::class, 'project_manager_id');
    }

    public function sdg(): BelongsTo {
        return $this->belongsTo(Sdg::class, 'current_sdg_id');
    }

    public function goals(): BelongsToMany
    {
        return $this->belongsToMany(Goal::class, 'goal_user', 'user_id', 'goal_id')
            ->withTimestamps();
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
