<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * class Province
 *  @property integer   $id
 *  @property string   $name
 * @property integer   $province_id
 */

class District extends Model
{
    use HasFactory;
    protected $table = 'district';
    protected $fillable = [
        'id',
        'name',
        'province_id',
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
