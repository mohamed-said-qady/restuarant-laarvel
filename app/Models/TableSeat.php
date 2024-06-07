<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TableSeat extends Model
{
    use HasFactory;

    protected $fillable = [
        'number',
        'status',
        'table_id',
    ];

    public function table()
    {
        return $this->belongsTo(Table::class);
    }
}
