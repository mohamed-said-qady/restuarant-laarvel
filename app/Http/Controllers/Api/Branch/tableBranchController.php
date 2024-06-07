<?php

namespace App\Http\Controllers\Api\Branch;

use App\Http\Controllers\Controller;
use App\Http\Resources\Receptionist\TableResource;
use App\Models\Table;
use App\Traits\ResponseApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class TableBranchController extends Controller
{
    use ResponseApi;
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $tables = QueryBuilder::for(Table::class)
        ->allowedFilters([
            AllowedFilter::exact('status'),
            AllowedFilter::exact('location'),
        ])
        ->get();
        $tables = $tables->where('branch_id',Auth::user()->branch->id);
        return $this->responseSuccess('show table',TableResource::collection($tables));
    }
}
