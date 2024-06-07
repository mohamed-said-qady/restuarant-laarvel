<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'      => ['required'],
            'email'     => ['required','email'],
            'password'  => ['required'],
            'phone'     => ['required'],
            'address'   => ['required'],
            'branch_id' => ['required','exists:branches,id'],
            'status'    => ['required','in:active,closed,canceled,blacklisted'],
            'role'      => ['required','exists:roles,name']
        ]; 
    }
}
