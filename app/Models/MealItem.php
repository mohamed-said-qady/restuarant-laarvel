<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MealItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_item_id',
        'meal_id',
        'quantity',
    ];

    public function meal()
    {
        return $this->belongsTo(Meal::class);
    }

    public function menuItem()
    {
        return $this->belongsTo(MenuItem::class,'menu_item_id');
    }

}
