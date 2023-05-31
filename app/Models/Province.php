<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * class Province
 *  @property integer   $id
 *  @property string   $name
 */

class Province extends Model
{
    use HasFactory;
    protected $table = 'province';
    protected $fillable = [
        'id',
        'name',
    ];
     /**
     * Get all of the products for the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function uses()
    {
        return $this->hasMany(User::class);
    }
}
