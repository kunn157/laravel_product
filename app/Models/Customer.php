<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use phpseclib3\Math\BigInteger;

class Customer extends Authenticatable
{
    use HasApiTokens, HasFactory;
    /**
     * class Customer
     * @property BigInteger    $id.
     * @property string        $phone.
     * @property string        $email.
     * @property date        $birthday.
     * @property string        $full_name.
     * @property string        $reset_password.
     * @property string        $address
     * @property BigInteger        $province_id.
     * @property BigInteger        $district_id.
     * @property BigInteger        $commune_id.
     * @property tinyint       $status.
     * @property tinyint       $flag_delete
     */
    protected $fillable = [
        'phone',
        'email',
        'birthday',
        'full_name',
        'address',
        'province_id',
        'district_id',
        'commune_id',
        'reset_password',
        'flag_delete',
        'status',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password', 'reset_password'
    ];
     /**
     * Get all of the orders for the Order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orders()
    {
        return $this->hasMany(Order::class ,'customer_id');
    }
     /**
     * Get all of the details for the OrderDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function details()
    {
        return $this->hasMany(OrderDetail::class ,'customer_id');
    }
}
