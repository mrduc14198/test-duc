<?php

namespace App\Models;

use App\Models\Traits\Methods\UserMethod;
use App\Models\Traits\Relationships\UserRelationship;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, UserRelationship, UserMethod;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
        'type',
        'provider',
        'provider_id',
        'remember_token',
        'role'
    ];

    public static $userTypes = [
        'customer' => 0,
        'supplier' => 1
    ];

    public static $getUserTypes = [
        0 => 'customer',
        1 => 'supplier',
    ];

    public static $userRoles = [
        'user'   => 0,
        'admin'  => 1,
    ];

    public static $getUserRoles = [
        0 => 'user',
        1 => 'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
