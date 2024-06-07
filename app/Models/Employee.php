<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Laratrust\Contracts\LaratrustUser;
use Laratrust\Traits\HasRolesAndPermissions;

class Employee extends Authenticatable implements LaratrustUser
{
    use HasApiTokens, HasFactory, Notifiable ,HasRolesAndPermissions;

    protected $fillable = [ 
        'name',
        'email',
        'password',
        'phone',
        'address',
        'status',
        'branch_id'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

}
