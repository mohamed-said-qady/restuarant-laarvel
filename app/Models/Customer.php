<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Traits\HasRolesAndPermissions;

class Customer extends Model
{
    use HasFactory ,HasApiTokens ,HasRolesAndPermissions;

    protected $fillable = [
        'name',
        'email',
        'phone',
        
    ];

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    


}
