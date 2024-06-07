<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreKitchenRequest;
use App\Http\Requests\UpdateKitchenRequest;
use App\Http\Resources\KitchenCollection; 
use App\Http\Resources\KitchenResource;
use App\Models\Kitchen;
use App\Traits\ResponseApi;
 
class KitchenController extends Controller
{

    use ResponseApi;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kitchens = Kitchen::paginate(10);
        return $this->responseSuccess('show all kitchens',new KitchenCollection($kitchens));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreKitchenRequest $request)
    {
        $kitchen = Kitchen::create($request->safe()->all());
        return $this->responseSuccess('kitchen has been created successfully!',new KitchenResource($kitchen));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $kitchen = Kitchen::find($id);
        if(!$kitchen)
        {
            return $this->responseError('not found kitchen this is id',404);
        }
        return $this->responseSuccess('show kitchen',new KitchenResource($kitchen));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateKitchenRequest $request, string $id)
    {
        $kitchen = Kitchen::find($id);
        if(!$kitchen)
        {
            return $this->responseError('not found kitchen this is id',404);
        }
        $kitchen->update($request->safe()->all());
        return $this->responseSuccess('kitchen has been updated successfully!',new KitchenResource($kitchen));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kitchen = Kitchen::find($id);
        if(!$kitchen)
        {
            return $this->responseError('not found kitchen this is id',404);
        }
        $kitchen->delete();
        return $this->responseSuccess('kitchen has been deleted successfully!',[]);
    }
}
