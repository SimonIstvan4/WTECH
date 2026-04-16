<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'User';
    protected $fillable = ['email', 'password', 'admin'];
    public $timestamps = false; 
}
