<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Resources\CustomerCollection;
use App\Http\Resources\CustomerResource;
use App\Models\Customer;
use App\Traits\ResponseApi;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    
    use ResponseApi;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::paginate(10);
        return $this->responseSuccess('show all customers',new CustomerCollection($customers));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCustomerRequest $request) 
    {
        $customer = Customer::firstOrCreate(['phone'=>$request->phone],$request->safe()->all());
        return $this->responseSuccess('customer has been created succesfully!',new CustomerResource($customer));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);
        if(!$customer)
        {
            return $this->responseError('not found customer this is id',404);
        }
        return $this->responseSuccess('customer has been created succesfully!',new CustomerResource($customer));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, string $id)
    {
        $customer = Customer::find($id);
        if(!$customer)
        {
            return $this->responseError('not found customer this is id',404);
        }
        $customer->update($request->safe()->all());
        return $this->responseSuccess('customer has been created succesfully!',new CustomerResource($customer));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::find($id);
        if(!$customer)
        {
            return $this->responseError('not found customer this is id',404);
        }
        $customer->delete();
        return $this->responseSuccess('customer has been created succesfully!',new CustomerResource($customer));
    }
}
