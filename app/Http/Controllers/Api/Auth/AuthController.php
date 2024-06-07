<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\registerRequest;
use App\Models\Employee;
use App\Models\Customer;
use App\Traits\ResponseApi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;
use Throwable;

class AuthController extends Controller
{

    use ResponseApi;
    public function login(LoginRequest $request)
    {
        try{
            if(!Auth::guard('api')->attempt($request->only(['email','password'])))
            {
                return $this->responseError('Password & Email does not match with', 401);
            } 
            
            $employee = Employee::where('email', $request->email)->first();
            $token = $employee->createToken('restaurant')->plainTextToken;
            
            return $this->responseSuccess('employee logged In successfully',$token);

        }catch(Throwable $th){
            return $this->responseException($th->getMessage());
        }
    }

    public function register(registerRequest $request)
   {
    //$this->call(LaratrustSeeder::class);
    try {
        $employee = new Employee();
        $employee->name = $request->input('name');
        $employee->email = $request->input('email');
        $employee->password = Hash::make($request->input('password'));
        $employee->phone = $request->input('phone');
        $employee->address = $request->input('address');
        $employee->save();
        $employee->addRole('customer'); 
        $token = $employee->createToken('restaurant')->plainTextToken;
        return $this->responseSuccess('Employee registered successfully', $token);
    } catch (Throwable $th) {
       // return $this->responseException($th->getMessage());
    } 
}

    public function update(LoginRequest $request)
    {
        try{
            $employee = Auth::user();
            $employee->update($request->all());
            return $this->responseSuccess('successfully!',[]);
        }catch(Throwable $th){
            return $this->responseException($th->getMessage());
        }
    }
}
