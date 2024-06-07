<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreMenuSectionRequest;
use App\Http\Requests\UpdateMenuSectionRequest;
use App\Http\Resources\MenuSectionCollection;
use App\Http\Resources\MenuSectionResource;
use App\Models\MenuSection;
use App\Traits\ResponseApi;

class MenuSectionController extends Controller
{
    use ResponseApi;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = MenuSection::paginate(10);
        return $this->responseSuccess('show all menu sections', new MenuSectionCollection($sections));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMenuSectionRequest $request)
    {
        $section = MenuSection::create($request->safe()->all());
        return $this->responseSuccess('menu section has been created successfully!',new MenuSectionResource($section));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $section = MenuSection::find($id);
        if(!$section)
        {
            return $this->responseError('not found menu this is id',404);
        }
        return $this->responseSuccess('show menu section',new MenuSectionResource($section));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMenuSectionRequest $request, string $id)
    {
        $section = MenuSection::find($id);
        if(!$section)
        {
            return $this->responseError('not found menu this is id',404);
        }
        $section->update($request->safe()->all());
        return $this->responseSuccess('menu section has been updated successfully!',new MenuSectionResource($section));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $section = MenuSection::find($id);
        if(!$section)
        {
            return $this->responseError('not found menu this is id',404);
        }
        $section->delete();
        return $this->responseSuccess('menu section has been deleted successfully!',[]);
    }
}
