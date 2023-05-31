<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    /**
     * class Order
     * @property bigInteger    $id.
     * @property bigInteger    $customer_id.
     * @property integer    $quantity.
     * @property integer $total.
     **/
    protected $fillable = [
        'customer_id',
        'quantity',
        'total',
    ];
     /**
     *  get Order details
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }
     /**
     *  get customer
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class ,'customer_id');
    }
}
