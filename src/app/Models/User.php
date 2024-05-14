<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Support\QuerySearch\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Filterable,
        HasFactory,
        Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     */
    protected $fillable = [
        'username',
        'name',
        'email',
        'auth_id'
    ];


    protected $casts = [
        'auth_id' => 'integer'
    ];

    /**
     * пользователи, на которых подписан этот пользователь
     * @return BelongsToMany
     */
    public function following(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'following_id');
    }

    /**
     * пользователи, которые подписали на этот пользователем
     * @return BelongsToMany
     */
    public function followers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'followers', 'following_id', 'follower_id');
    }
}
