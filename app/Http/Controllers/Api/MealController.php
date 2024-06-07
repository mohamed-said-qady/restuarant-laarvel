<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MealRequest;
use App\Http\Resources\MealResource;
use App\Models\Meal;
use App\Traits\ResponseApi;

class MealController extends Controller
{
    use ResponseApi; 


    public function addMeal(MealRequest $request){
        $meal = Meal::create($request->safe()->all());
        return $this->responseSuccess('meal has been created successfully!',new MealResource($meal));
    }

    public function remove(string $id)
    {
        $meal = Meal::find($id);
        if(!$meal)
        {
            $this->responseError('not found meal this is id',404);
        }
        $meal->delete();
        return $this->responseSuccess('meal has been updated successfully!',[]);
    }

}
