<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meal extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_seat_id',
        'order_id'
    ];

    public function order() 
    {
        return $this->belongsTo(Order::class);
    } 

    public function seat()
    {
        return $this->belongsTo(TableSeat::class,'table_seat_id');
    }

    public function items()
    {
        return $this->hasMany(MealItem::class);
    }

}
