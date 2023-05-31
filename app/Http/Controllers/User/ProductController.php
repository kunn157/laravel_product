<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Barryvdh\DomPDF\Facade\PDF;
use RealRashid\SweetAlert\Facades\Alert;
use Log;
use App;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Products;
use App\Http\Requests\Products\CreateProducts;
use App\Http\Requests\Products\UpdateProducts;
use App\Services\Products\ProductService;
use App\Services\Upload\UploadService;


class ProductController extends Controller
{
     /**
     * Instantiate a new ProductService instance.
     */
    public function __construct(ProductService $productService , UploadService $uploadService) {
        $this -> productService = $productService;
        $this -> uploadService = $uploadService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $this ->productService ->getAll($request);
        return view('user.products.index' , compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = $this -> productService ->getCategory();
        return view('user.products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Products\CreateProducts;  $request
     * @return App\Http\Requests\Products\CreateProducts;
     * @return \Illuminate\Http\Response
     */
    public function store(CreateProducts $request)
    {
        try {
            $result = $this->productService->storeProduct($request);
            if($result){
                return redirect()->route('products.index') ->with('success',__("messages.createSuccess"));
            }else{
                return back()->with('error', __('Failed to Add Product'));
            }
        }catch (\Exception $exception){
            Log::error("Message: {$exception->getMessage()}. Line: {$exception->getLine()}");
        }
    }
    /**
     * Show the form for editing the specified resource.
     * @param \App\Models\Product $product
     * @param  \App\Models\Category
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $product)
    {
        $categories = $this -> productService ->getCategory();
        return view('user.products.edit',compact('categories','product'));
    }

   /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Requests $request
     * @param  \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */

    public function update(UpdateProducts $request, Products $product)
    {
        try {
            $result = $this->productService->updateProduct($request,$product);
            if($result){
                return redirect()->route('products.index')->with('success', __("messages.updateSuccess"));
            }else{
                return back()->with('error', __('Failed to Add Product'));
            }
        }catch (\Exception $exception){
            Log::error("Message: {$exception->getMessage()}. Line: {$exception->getLine()}");
        }
    }

   /**
     * Remove the specified resource from storage.
     *Delete Product
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Products $product)
    {
        return $this->productService->deleteProduct($product);
    }
    /**
     * Display a listing of the resource.
     *download file PDF
     * @return \Illuminate\Http\Response
     */
    public function generatePDF(){
       return $this->productService->generatePDF();
    }
    /**
     * Display a listing of the resource.
     *download file CSV
     * @return \Illuminate\Http\Response
     */
    public function generateCSV(){
       return $this->productService->generateCSV();
    }

}
