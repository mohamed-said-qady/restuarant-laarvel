<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MealItemRequest;
use App\Http\Resources\MealItemResource;
use App\Models\MealItem;
use App\Traits\ResponseApi;

class MealItemController extends Controller
{
    use ResponseApi; 


    public function addMealItem(MealItemRequest $request){
        $mealItem = MealItem::create($request->safe()->all());
        return $this->responseSuccess('mealItem has been created successfully!',new MealItemResource($mealItem));
    }

    public function remove(string $id)
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
