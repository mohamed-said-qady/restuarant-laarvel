<?php

namespace App\Rules;

use App\Models\Table;
use Closure; 
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Auth;

class ExistsTable implements ValidationRule 
{
    /**
     * Run the validation rule. 
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $branch_id = Auth::user()->branch->id;
        $table = Table::where('branch_id',$branch_id)->where('id',$value)->get();
        if(!$table)
        {
            $fail('no found table in this branch.');
        }
    }
}
