<?php

namespace App\Rules;

use App\Enums\TableStatus;
use App\Models\Table; 
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TableFree implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $table = Table::find($value); 
        if($table->status != TableStatus::Free)
        {
            $fail('this '.$table->location.' table\'s location is reserved.');
        } 
    }
}
