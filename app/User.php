<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    const COLUMN_USERNAME = 'name';
    const COLUMN_EMAIL = 'email';
    const COLUMN_PASSWORD = 'password';
    const COLUMN_REGISTRATION_IP = 'ip_registration';
    const COLUMN_CREATED = 'created_at';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::COLUMN_USERNAME,
        self::COLUMN_EMAIL,
        self::COLUMN_PASSWORD,
        self::COLUMN_REGISTRATION_IP
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        self::COLUMN_PASSWORD
    ];
}
