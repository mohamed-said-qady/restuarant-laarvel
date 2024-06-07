<?php

namespace App\Rules;

use App\Models\TableSeat;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueTableSeat implements ValidationRule
{

    public $table;

    public function __construct($table)
    {
        $this->table = $table;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    { 
        $table = TableSeat::where('table_id',$this->table)->where('number',$value)->first();
        if($table)
        {
            $fail('The :attribute must be unique in table.');
        }
    }
}
