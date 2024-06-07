<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Table extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'location',
        'capacity',
        'status',
        'branch_id'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function seats()
    {
        return $this->hasMany(TableSeat::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reservations()
    {
        return $this->belongsToMany(Reservation::class,'reservations_tables','table_id','reservation_id');
    }

}
