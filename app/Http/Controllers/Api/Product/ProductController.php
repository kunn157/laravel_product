<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Services\Products\ProductServiceAPI;
class ProductController extends Controller
{
     /** create productApi instance
     *
     * @var $productApi
     */
    protected $productApi;
    /**
     * Create a new controller instance.
     * @param $ProductServiceAPI $ProductServiceAPI
     * @return void
     */
    public function __construct(ProductServiceAPI $productApi)
    {
        $this->productApi = $productApi;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try{
          $result = $this->productApi->index();
        return response()->json([$result,'success' => 'Customer show successfully.', Response::HTTP_OK]);
        }catch (\Exception $exception){
            return response()->json(['error' => "Lỗi" , Response::HTTP_NOT_FOUND]);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    /**
     * get information about products
     *@param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getDetailProduct($id)
    {
       try{
        $result = $this->productApi->getDetailProduct($id);
        return response()->json([$result,'success' => 'Customer getDetailProduct successfully.', Response::HTTP_OK]);
       }catch (\Exception $exception){
        return response()->json(['error' => "Lỗi" , Response::HTTP_NOT_FOUND]);
        }
    }

}
