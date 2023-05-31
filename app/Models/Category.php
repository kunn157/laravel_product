<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


/*
*Class Category
* @property integer $id
* @property string $name
* @property int $parent_id
* @property timestamp $created_at
* @property timestamp $updated_at

*/

class Category extends Model
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'category';
    protected $fillable = [
        'id',
        'name',
        'parent_id',
        'created_at',
        'updated_at',
    ];

     /**
     * Create relationship between parent category and child category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parentCategory()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }
     /**
     * compare parent category if has child categories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function childCategory()
    {
        return $this->hasMany(Category::class,  'parent_id');
    }
    /**
     * Get all of the products for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
