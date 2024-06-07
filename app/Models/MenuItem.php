<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'price',
        'menu_section_id'
    ];

    public function section()
    {
        return $this->belongsTo(MenuSection::class,'menu_section_id');
    }
    
}
