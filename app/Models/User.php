<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;
    use SoftDeletes;

    protected $table = 'users';

    protected $fillable = [
        'name', 'pic', 'phoneNumber', 'password', 'role', 'taxiSets', 'isAvailable',
    ];

    public $timestamps = false;

}
