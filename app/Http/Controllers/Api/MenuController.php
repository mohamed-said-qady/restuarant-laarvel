<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Requests\UpdateMenuRequest;
use App\Http\Resources\MenuCollection;
use App\Http\Resources\MenuResource;
use App\Models\Menu;
use App\Traits\ResponseApi;
use Illuminate\Http\Request;

class MenuController extends Controller
{

    use ResponseApi; 

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $menus = Menu::paginate(10);
        return $this->responseSuccess('show all menu',new MenuCollection($menus));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuRequest $request)
    {
        $menu = Menu::create($request->safe()->all());
        return $this->responseSuccess('menu has been created successfully!',new MenuResource($menu));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $menu = Menu::find($id);
        if(!$menu)
        {
            return $this->responseError('not found menu this is id',404);
        }
        return $this->responseSuccess('show menu',new MenuResource($menu));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuRequest $request, string $id)
    {
        $menu = Menu::find($id);
        if(!$menu)
        {
            $this->responseError('not found menu this is id',404);
        }
        $menu->update($request->safe()->all());
        return $this->responseSuccess('menu has been updated successfully!',new MenuResource($menu));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $menu = Menu::find($id);
        if(!$menu)
        {
            $this->responseError('not found menu this is id',404);
        }
        $menu->delete();
        return $this->responseSuccess('menu has been updated successfully!',[]);
    }
}
