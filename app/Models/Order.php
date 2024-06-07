<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'table_id'
    ];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function meals() 
    {
        return $this->hasMany(Meal::class);
    }

}
