<?php

namespace App\Http\Controllers\Api\Employee;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Waiter\RemoveItemRequest;
use App\Http\Requests\Waiter\RemoveMealRequest;
use App\Http\Requests\Waiter\StoreItemRequest;
use App\Http\Requests\Waiter\StoreMealRequest;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\StoreMealItemRequest;
use App\Http\Resources\OrderResource;
use App\Http\Resources\MealResource;
use App\Http\Resources\MealItemResource;
use App\Models\Meal;
use App\Models\MealItem;
use App\Models\Order;
use App\Traits\ResponseApi;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class WaiterController extends Controller
{
    
    use ResponseApi;

    public function __construct()
    {
        $this->middleware('role:waiter|manager');
    }

    public function showOrders()
    {
        $order = Order::paginate(10);
        return $this->responseSuccess('show all orders', new OrderResource($order));
    }



    public function addOrder(StoreOrderRequest $request){
        $order = Order::create($request->safe()->all());
        return $this->responseSuccess('order has been created successfully!',new OrderResource($order));
    }

    public function addMeal(StoreMealRequest $request)
    {
        $meal = Meal::create($request->safe()->all());
        return $this->responseSuccess('Meal has been added successfully!',new MealResource($meal));
    }

    public function removeMeal(RemoveMealRequest $request)
    {
        $meal = Meal::find($request->meal_id);
        $meal->delete();
        return $this->responseSuccess('Meal has been Removed Successfully!',[]);
    }

    public function addItem(StoreItemRequest $request)
    {
        $item = MealItem::create($request->safe()->all()); 
        return $this->responseSuccess('meal\'s item has been added successfully!',new MealItemResource($item));
    }

    public function removeItem(string $id)
    {
        $mealItem = MealItem::find($id);
        if(!$mealItem)
        {
            $this->responseError('not found mealItem this is id',404);
        }
        $mealItem->delete();
        return $this->responseSuccess('mealItem has been updated successfully!',[]);
    }

}
