<?php

namespace App\Http\Requests\Waiter;

use App\Rules\UniqueMealSeat;
use Illuminate\Foundation\Http\FormRequest;

class StoreMealRequest extends FormRequest
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
            'order_id'      => ['required','exists:orders,id'],
            'table_seat_id' => ['required','exists:table_seats,id',new UniqueMealSeat($this->order_id)],
        ];
    }
}
