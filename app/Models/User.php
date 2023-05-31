<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * class User
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

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'email',
        'user_name',
        'birthday',
        'first_name',
        'last_name',
        'password',
        'status',
        'avatar',
        'address',
        'province_id',
        'district_id',
        'commune_id',
        'flag_delete',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
     /**
     * Get the category that owns the Products
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
     /**
     * Get the category that owns the Products
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function district()
    {
        return $this->belongsTo(District::class);
    }
     /**
     * Get the category that owns the Products
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function commune()
    {
        return $this->belongsTo(Commune::class);
    }
}
