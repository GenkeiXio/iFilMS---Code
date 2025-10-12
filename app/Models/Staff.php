<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    protected $table = 'staff';
    protected $primaryKey = 'staff_id'; // 👈 if your table uses staff_id, not id

    protected $fillable = ['name', 'username', 'password'];

    protected $hidden = ['password'];

    public $timestamps = false;
}