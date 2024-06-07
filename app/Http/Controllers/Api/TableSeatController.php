<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTableSeatRequest;
use App\Http\Requests\UpdateTableSeatRequest;
use App\Http\Resources\TableSeatCollection;
use App\Http\Resources\TableSeatResource;
use App\Models\TableSeat;
use App\Traits\ResponseApi;

class TableSeatController extends Controller
{
    use ResponseApi;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seats = TableSeat::paginate(10);
        return $this->responseSuccess('show all seats',new TableSeatCollection($seats));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTableSeatRequest $request)
    {
        $seat = TableSeat::create($request->safe()->all());
        return $this->responseSuccess('seat\'s table has been created successfully!',new TableSeatResource($seat));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $seat = TableSeat::find($id);
        if(!$seat)
        {
            return $this->responseError('not found seat this is id',404);
        }
        return $this->responseSuccess('show seat',new TableSeatResource($seat));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTableSeatRequest $request, string $id)
    {
        $seat = TableSeat::find($id);
        if(!$seat)
        {
            return $this->responseError('not found seat this is id',404);
        }
        $seat->update($request->safe()->all());
        return $this->responseSuccess('seat\'s table has been updated successfully!',new TableSeatResource($seat));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $seat = TableSeat::find($id);
        if(!$seat)
        {
            return $this->responseError('not found seat this is id',404);
        }
        $seat->delete();
        return $this->responseSuccess('seat\'s table has been deleted successfully!',[]);
    }
}
