<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{
    protected $table = 'staff';
    protected $primaryKey = 'staff_id';

    protected $fillable = [
        'name',
        'username',
        'password',
        'role',
        'status',
        'permissions'
    ];

    protected $hidden = ['password'];

    protected $casts = [
        'permissions' => 'array',
    ];

    public $timestamps = true;

    //ROLE HELPERS
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isStaff()
    {
        return $this->role === 'staff';
    }

    //PERMISSION SYSTEM 
    // Admin ALWAYS allowed
    public function hasPermission($permission)
    {
        if ($this->isAdmin()) {
            return true;
        }

        return $this->permissions[$permission] ?? false;
    }

    public function canView()
    {
        return $this->hasPermission('view');
    }

    public function canDownload()
    {
        return $this->hasPermission('download');
    }

    public function canDelete()
    {
        return $this->hasPermission('delete');
    }

    public function canUpload()
    {
        return $this->hasPermission('upload');
    }
}
