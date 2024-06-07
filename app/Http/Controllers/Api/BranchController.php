<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBranchRequest;
use App\Http\Requests\UpdateBranchRequest;
use App\Http\Resources\BranchResource;
use App\Models\Branch;
use App\Traits\ResponseApi;
use Illuminate\Contracts\Encryption\DecryptExeption;
Use Illuminate\Support\Facades\Crypt;

class BranchController extends Controller
{

    use ResponseApi;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $branch = Branch::paginate(20);    
         return $this->responseSuccess('show all branches',BranchResource::collection($branch));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBranchRequest $request)
    {
            $branch = Branch::create($request->safe()->all());
            return $this->responseSuccess('branch has been created successfully!',new BranchResource($branch));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $branch = Branch::find($id);
        if(!$branch)
        {
            return $this->responseError('not found branch this is id',404);
        }
        return $this->responseSuccess('show one branch',new BranchResource($branch));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBranchRequest $request, string $id)
    {
        $branch = Branch::find($id);
        if(!$branch)
        {
            return $this->responseError('not found branch this is id',404);
        }
        $branch->update($request->safe()->all());
        return $this->responseSuccess('branch has been updated successfully!',new BranchResource($branch));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $branch = Branch::find($id);
        if(!$branch || $branch->emloyees)
        {
            return $this->responseError('you can\'t deleted',404);
        }
        $branch->delete();
        return $this->responseSuccess('branch has been deleted successfully!',[]);
    }
}
