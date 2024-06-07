<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Http\Resources\EmployeeCollection;
use App\Http\Resources\EmployeeResource;
use App\Models\Employee;
use App\Traits\ResponseApi;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{

    use ResponseApi;


    public function index()
    {
        $employees = Employee::paginate(20);
        return $this->responseSuccess('show all employees',new EmployeeCollection($employees));
    }

    /**
     * Store a newly created resource in storage.
     */ 
    public function store(StoreEmployeeRequest $request)
    {
        $request['password'] = Hash::make($request->password);
        $employee = Employee::create($request->safe()->all());
        $employee->addRole($request->role);
        return $this->responseSuccess('employee has been created successfully!',new EmployeeResource($employee));
    } 

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $employee = Employee::find($id);
        if(!$employee)
        {
            return $this->responseError('not found employee this is id',404);
        }
        return $this->responseSuccess('show employee',new EmployeeResource($employee));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, string $id)
    {
        $employee = Employee::find($id);
        if(!$employee)
        {
            return $this->responseError('not found employee this is id',404);
        }
        if($request->password)
        {
            $request['password'] = Hash::make($request->password);
        }
        $employee->update($request->safe()->all());
        $employee->syncRoles([$request->role]);
        return $this->responseSuccess('employee has been updated successfully',new EmployeeResource($employee));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $employee = Employee::find($id);
        if(!$employee)
        {
            return $this->responseError('not found employee this is id',404);
        }
        $employee->delete();
        return $this->responseSuccess('employee has been deleted successfully',[]);
    }
}
