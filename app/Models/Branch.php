<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    
    protected $fillable = [ 
        'name',
        'location',
        'restaurant_id'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }

    public function kitchen()
    {
        return $this->hasOne(Kitchen::class);
    }

    public function tables()
    {
        return $this->hasMany(Table::class);
    }

    public function menu()
    {
        return $this->hasOne(Menu::class);
    }

}
