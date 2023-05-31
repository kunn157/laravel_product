<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    /**
     * class OrderDetail
     * @property bigInteger    $id.
     * @property bigInteger    $order_id.
     * @property bigInteger    $product_id.
     * @property integer    $quantity.
     * @property integer $price.
     * @property integer $status
     **/
    protected $table = 'order_detail';
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'status'
    ];
     /**
     *  get Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product that owns the Products
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Products::class);
    }
     /**
     * Get the customer that owns the Customer
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
