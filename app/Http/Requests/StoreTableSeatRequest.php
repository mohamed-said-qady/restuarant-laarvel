<?php

namespace App\Http\Requests;

use App\Rules\UniqueTableSeat;
use Illuminate\Foundation\Http\FormRequest;

class StoreTableSeatRequest extends FormRequest
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
            'table_id'  => ['required','exists:tables,id'],
            'number'    => ['required','numeric',new UniqueTableSeat($this->table_id)],
            'status'    => ['required','in:regular,kid,accessible,other']
        ];
    }
}
