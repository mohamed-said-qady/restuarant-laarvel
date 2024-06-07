<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'branch_id'
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function sections()
    {
        return $this->hasMany(MenuSection::class);
    }

}
