<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTableRequest;
use App\Http\Requests\UpdateTableRequest;
use App\Http\Resources\TableCollection;
use App\Http\Resources\TableResource;
use App\Models\Table;
use App\Traits\ResponseApi;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TableController extends Controller
{

    use ResponseApi;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = Table::paginate(10);
        return $this->responseSuccess('show all tables',new TableCollection($tables));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTableRequest $request) 
    {
        $table = Table::create($request->safe()->all());
        return $this->responseSuccess('table has been created successfully!',new TableResource($table));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $table = Table::find($id);
        if(!$table) 
        {
            return $this->responseError('not found table this is id',404);
        }
        return $this->responseSuccess('show table',new TableResource($table));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTableRequest $request, string $id)
    {
        $table = Table::find($id);
        if(!$table)
        {
            return $this->responseError('not found table this is id',404);
        }
        $table->update($request->safe()->all());
        return $this->responseSuccess('table has been updated successfully!',new TableResource($table));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $table = Table::find($id);
        if(!$table)
        {
            return $this->responseError('not found table this is id',404);
        }
        $table->delete();
        return $this->responseSuccess('table has been deleted successfully!',[]);
    }
}
