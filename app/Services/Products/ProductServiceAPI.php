<?php

namespace App\Services\Products;
use App\Services\BaseService;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductServiceAPI extends BaseService
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Products::class;
    }
    public function index()
    {
            $product = Products::select([
            'id',
            'name',
            'stock',
            'avatar',
            'category_id'
        ])->orderBy('id', 'DESC')->paginate(10);
        return $product;
    }
    public function getDetailProduct($id)
    {
        $product = Products::select([
            'id',
            'name',
            'stock',
            'avatar',
            'category_id'
        ])->findOrFail($id);
        return $product;
    }
}

