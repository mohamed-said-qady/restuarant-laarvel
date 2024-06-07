<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuItemRequest;
use App\Http\Requests\UpdateMenuItemRequest;
use App\Http\Resources\MenuItemCollection;
use App\Http\Resources\MenuItemResource;
use App\Models\MenuItem;
use App\Traits\ImageFile;
use App\Traits\ResponseApi; 

class MenuItemController extends Controller
{

    use ResponseApi,ImageFile;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = MenuItem::paginate(20);
        return $this->responseSuccess('show all items',new MenuItemCollection($items));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuItemRequest $request)
    {
        $request = $this->uploadImage($request,'items');
        $item = MenuItem::create($request->all());
        return $this->responseSuccess('menu item has been created successfully!',new MenuItemResource($item));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = MenuItem::find($id);
        if(!$item)
        {
            return $this->responseError('not found item this is id',404);
        }
        return $this->responseSuccess('show item',new MenuItemResource($item));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuItemRequest $request, string $id)
    {
        $item = MenuItem::find($id);
        if(!$item)
        {
            return $this->responseError('not found item this is id',404);
        }
        $request = $this->updateImage($request,$item->image,'items');
        $item->update($request->all());
        return $this->responseSuccess('menu item has been udpated successfully!',new MenuItemResource($item));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $item = MenuItem::find($id);
        if(!$item)
        {
            return $this->responseError('not found item this is id',404);
        }
        $this->deleteImage($item->image,'items');
        $item->delete();
        return $this->responseSuccess('menu item has been deleted successfully!',[]);
    }
}
