<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderDetail;
use Barryvdh\DomPDF\Facade\PDF;
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders  = Order::Select('id','customer_id','quantity' , 'total')->get();
        return view('user.order.index', compact('orders'));
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
     * Show the form  the specified resource.
     * @param \App\Models\Order $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order )
    {
        $orderdetails = OrderDetail::select('id','order_id','product_id', 'quantity', 'price')->where('order_id',$order->id)->get();
        return view('user.order.details.show' ,compact('order','orderdetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
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
     * Display a listing of the resource.
     *download file PDFs
     * @return \Illuminate\Http\Response
     */
    public function generatePDF(Order $order){
        $data['orderdetails'] = OrderDetail::select(
            'id',
            'order_id',
            'product_id',
            'quantity',
            'price')->where('order_id',$order->id)->get();
        $pdf  = PDF::loadView('user.order.details.oderdetail_pdf',$data, compact('order'))->setPaper('A4', 'landscape');
        return $pdf->download('orderdetails.pdf');
    }
}
