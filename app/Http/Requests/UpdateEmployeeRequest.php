<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'name'      => ['nullable'],
            'email'     => ['nullable','email'],
            'password'  => ['nullable'],
            'phone'     => ['nullable','numeric'],
            'address'   => ['nullable'],
            'branch_id' => ['nullable','exists:branches,id'],
            'status'    => ['nullable','in:active,closed,canceled,blacklisted'],
            'role'      => ['nullable','exists:roles,name'],
        ];
    }
}
