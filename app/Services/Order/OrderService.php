<?php


namespace App\Services\Order;


use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Products;
use App\Services\BaseService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderService extends BaseService
{
    /**
     * get model
     * @return string
     */
    public function getModel()
    {
        return Order::class;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return array[]
     */
    public function store(Request $request){
        DB::beginTransaction();
        $idCustomer = auth()->guard('api')->user()->id;
        $idProduct = $request->id;
        if(empty($idProduct)){
            return false;
        }
        $products = Products::select('id', 'name', 'stock', 'price')->whereIn('id', $idProduct)->get();
        $productCount = array_count_values($idProduct);
        $total = 0;
        $quantity_order = 0;
        $orders = array();
        try {
            foreach ($products as $product){
                if($product->stock > 0){
                    $product->stock -= $productCount[$product->id];
                    $product->save();
                    $orders = array(
                        'customer_id' => $idCustomer,
                        'quantity' => $quantity_order += $productCount[$product->id],
                        'total' => $total += $product->price * $productCount[$product->id]
                    );
                }else{
                    $error[] = __('Out of stock product') . $product->name;
                }
            }
            $order = $this->_model::create($orders);
            foreach ($products as $pro){
                if($pro->stock > 0){
                    OrderDetail::create([
                        'order_id' => $order->id,
                        'product_id' => $pro->id,
                        'quantity' => $productCount[$pro->id],
                        'price' => $pro->price * $productCount[$pro->id],
                        'status' => 1
                    ]);
                }
            }
            $order_detail = OrderDetail::select('order_detail.id', 'order_id', 'product_id', 'quantity', 'order_detail.price', 'status')
                ->where('order_id', $order->id)->join('products', 'products.id', '=', 'order_detail.product_id')
                ->get()->toArray();
            DB::commit();
            return [
                'order' => $order,
                'order_detail' => $order_detail,
                'error' => $error ?? false
            ];
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error("Message: {$exception->getMessage()}. Line: {$exception->getLine()}");
            return false;
        }
    }
}
