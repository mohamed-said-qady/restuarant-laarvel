<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Traits\ResponseApi;

class OrderController extends Controller
{
    use ResponseApi; 


    public function addOrder(OrderRequest $request){
        $order = Order::create($request->safe()->all());
        return $this->responseSuccess('order has been created successfully!',new OderResource($order));
    }

    public function showOrder()
    {
        $order = Order::paginate(10);
        return $this->responseSuccess('show all orders', new OrderResource($order));
    }

}
