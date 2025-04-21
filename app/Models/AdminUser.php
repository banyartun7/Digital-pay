<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class AdminUser extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    public function getNameAttribute($value){
        return ucwords($value);
    }
    
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }
}
