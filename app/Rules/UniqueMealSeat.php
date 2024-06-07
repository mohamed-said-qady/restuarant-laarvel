<?php

namespace App\Rules;

use App\Models\Meal;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueMealSeat implements ValidationRule
{
     
    public $order; 

    public function __construct($order) 
    {
        $this->order = $order; 
    } 
    /**
     * Run the validation rule. 
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $table = Meal::where('order_id',$this->order)->where('table_seat_id',$value)->first();
        if($table)
        {
            $fail('The :attribute must be unique in order.');
        }
    }
}
