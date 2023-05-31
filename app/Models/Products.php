<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/*
*Class Products
* @property integer $id
* @property string $sku
* @property string $name
* @property int $stock
* @property string $avatar
* @property date $expired_at
* @property int $parent_id
* @property timestamp $created_at
* @property timestamp $updated_at

*/
class Products extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'sku',
        'name',
        'stock',
        'avatar',
        'price',
        'expired_at',
        'category_id',
        'created_at',
        'updated_at',
    ];
    /**
     * Get the category that owns the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
     /**
     * Get all of the orderdetail for the OrderDetail
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderdetail()
    {
        return $this->hasMany(OrderDetail::class);
    }
}
