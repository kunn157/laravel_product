<?php

namespace App\Services\Products;

use App\Models\Products;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\PDF;
use App\Services\Upload\UploadService;
use Log;
use App\Http\Requests\Products\CreateProducts;
use App\Http\Requests\Products\UpdateProducts;


class ProductService
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Products::class;
    }
    /**
     * Instantiate a new ProductService instance.
     */
    public function __construct( UploadService $uploadService)
    {
        $this -> uploadService = $uploadService;
    }
     /**
     * Handle product management list.
     *
     * @param Request $request
     *
     */
    public function getAll(Request $request)
    {
        $search_product = $request -> search_product;
        $select_stock = $request -> select_stock;
        $data = Products::select([
            'id',
            'name',
            'stock',
            'expired_at',
            'avatar',
            'sku',
            'category_id',
        ]);
        if ($request -> has('search_product') && !is_null($search_product)){
            $data->whereHas('category', function ($query) use ($search_product) {
                $query->where('name', 'like', "%{$search_product}%");
            })->orWhere('name', 'like', "%{$search_product}%");
        }
        if ($request -> has('select_stock')){
            switch ($select_stock) {
                case 1:
                $data -> where('stock',"<",10);
                break;
                case 2:
                    $data -> whereBetween('stock',[10,100]);
                    break;
                case 3:
                    $data -> whereBetween('stock',[100,200]);
                    break;
                case 4:
                    $data -> where('stock',">",200);
                    break;
            };
        }
        $products = $data->paginate(15);
        return $products;
    }
    /**
     * get categories.
     *
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function getCategory()
    {
        $categories = Category::select('id', 'name', 'parent_id')->get();
        return $categories;
    }
  /**
     * Store a newly created resource in storage.
     *
     * @param  CreateProducts  $request
     * @return bool
     */
    public function storeProduct(CreateProducts $request)
    {
        DB::beginTransaction();
        try {
        $avatar = $this->uploadService->uploadImg($request);
            $products = Products::create([
            'name' => $request->name,
            'stock' =>$request->stock,
            'expired_at' => $request->expired_at,
            'avatar' => $avatar,
            'sku' => $request->sku,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);
       DB::commit();
            return true;
        }catch (\Exception $e) {
            DB::rollBack();
            Log::error("Message: {$exception->getMessage()}. Line: {$exception->getLine()}");
            return false;
        }
    }
     /**
     * Update the specified resource in storage.
     *
     * @param  use\App\Http\Requests\Products\UpdateProducts;  $request
     * @param  \App\Models\Product
     * @return \Illuminate\Http\Response
     */

    public function updateProduct(UpdateProducts $request, Products $product)
    {
        DB::beginTransaction();
        try {
            $avatar = $this->uploadService->uploadImg($request);
                $product->update([
                'name' => $request->name,
                'stock' =>$request->stock,
                'expired_at' => $request->expired_at,
                'sku' => $request->sku,
                'avatar' => $avatar,
                'price' => $request->price,
                'category_id' => $request->category_id]);
            DB::commit();
            return true;
        }catch (\Exception $e) {
            DB::rollBack();
            Log::error("Message: {$exception->getMessage()}. Line: {$exception->getLine()}");
            return false;
        }
    }
     /**
     *  delete product
     *
     * @param $request
     * @param $product
     * @return response
     */
    public function deleteProduct(Products $product)
    {
        DB::beginTransaction();
        try {
            $product->delete();
            DB::commit();
            return response('Post deleted successfully.', Response::HTTP_OK);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            return back()->with('error', 'Delete products failed');
        }

    }
    /**
     * Display a listing of the resource.
     *download file PDF
     * @return \Illuminate\Http\Response
     */
    public function generatePDF(){
        $data['products'] = Products::select([
            'id',
            'name',
            'stock',
            'sku',
            'expired_at',
        ])->get();
        $pdf  = PDF::loadView('user.products.pdf',$data)->setPaper('A4', 'landscape');
        return $pdf->download('Product.pdf');
    }
     /**
     * Display a listing of the resource.
     *download file CSV
     * @return \Illuminate\Http\Response
     */
    public function generateCSV(){
        $list = Products::select([
            'id',
            'name',
            'stock',
            'sku',
            'expired_at',
        ])->get()->toArray();
        $fileName = 'Product.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
        );
        $callback = function() use ($list) {
        $file = fopen('php://output', 'w');
            foreach ($list as $lists) {
                fputcsv($file,$lists);
            }
            fclose($file);
            };
        return response()->stream($callback, Response::HTTP_OK , $headers);
    }
}

