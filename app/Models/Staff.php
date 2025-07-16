<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    protected $table = 'staff';
    protected $primaryKey = 'staff_id';

    protected $fillable = ['name', 'username', 'password'];

    protected $hidden = ['password'];

    public $timestamps = false;
}