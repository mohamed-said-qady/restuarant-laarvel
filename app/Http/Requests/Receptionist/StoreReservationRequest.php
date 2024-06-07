<?php

namespace App\Http\Requests\Receptionist;

use App\Rules\ExistsTable;
use App\Rules\TableFree;
use Illuminate\Foundation\Http\FormRequest;

class StoreReservationRequest extends FormRequest
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
            'reservation_time'  => ['required','date'],
            'people_count'      => ['required','numeric'],
            'note'              => ['nullable','string'],
            'checkin_time'      => ['nullable','date'],
            'customer_id'       => ['required','exists:customers,id'],
            'tables.*'          => ['required','exists:tables,id',new ExistsTable(),new TableFree()]
        ];
    }
}
