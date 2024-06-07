<?php

namespace App\Rules;

use App\Models\Table;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueTable implements ValidationRule
{

    public $branch;

    public function __construct($branch)
    {
        $this->branch = $branch;
    }
 
    /** 
     * Run the validation rule.
     * 
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $table = Table::where('branch_id',$this->branch)->where('location',$value)->first();
        if($table)
        {
            $fail('The :attribute must be unique in branch.');
        }
    }
}
