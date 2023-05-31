<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;


/**
 * class Admin
 *  @property string   $email
 *  @property string   $user_name
 *  @property date   $birthday
 *  @property string   $first_name
 *  @property string   $last_name
 *  @property string   $password
 *  @property string   $reset_password
 *  @property string   $status
 *  @property tinyinteger   $flag_delete
 */


class Admin extends Authenticatable
{
    use HasFactory;

    protected $guard = "admin";

    protected $fillable = [
        'id',
        'email',
        'user_name',
        'birthday',
        'first_name',
        'last_name',
        'password',
        'status',
        'flag_delete',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
