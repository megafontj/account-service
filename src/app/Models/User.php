<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Support\QuerySearch\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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

}
