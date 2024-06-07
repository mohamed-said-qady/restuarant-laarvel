<?php

namespace App\Http\Controllers\Api\Branch;

use App\Http\Controllers\Controller;
use App\Http\Resources\MenuItemResource;
use App\Models\MenuItem;
use App\Traits\ResponseApi;
use Illuminate\Support\Facades\Auth;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class MenuItemBranchController extends Controller
{
    use ResponseApi;

    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $items = MenuItem::withWhereHas('section',function($query){
            $query->whereHas('menu',function($query){
                $query->where('branch_id',Auth::user()->branch->id);
            });
        });
        $items = QueryBuilder::for($items)
        ->allowedFilters([
            AllowedFilter::exact('section.name'),
            'title',
        ])->get();
        return $this->responseSuccess('show menu items',MenuItemResource::collection($items));
    }
}
