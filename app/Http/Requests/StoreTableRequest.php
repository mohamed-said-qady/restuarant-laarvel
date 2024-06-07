<?php

namespace App\Http\Requests;

use App\Rules\UniqueTable;
use Illuminate\Foundation\Http\FormRequest;

class StoreTableRequest extends FormRequest
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
            'capacity'  => ['required','numeric'],
            'status'    => ['required','in:free,reserved,occupied,other'],
            'branch_id' => ['required','exists:branches,id'],
            'location'  => ['required',new UniqueTable($this->branch_id)],
        ];
    }
}
