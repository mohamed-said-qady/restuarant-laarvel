<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_time',
        'people_count',
        'status',
        'note',
        'checkin_time',
        'customer_id'
    ]; 

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function tables()
    {
        return $this->belongsToMany(Table::class,'reservations_tables','reservation_id','table_id');
    }

}
