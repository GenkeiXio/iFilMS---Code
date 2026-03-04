<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff; 

class StaffSeeder extends Seeder
{
    public function run()
    {
        staff::create([
            'name' => 'Admin',
            'username' => 'admin@bicol-u.edu.ph',
            'password' => Hash::make('OUBSAdmin'),
            'role' => 'admin'
        ]);

        staff::create([
            'name' => 'Staff',
            'username' => 'staff1@bicol-u.edu.ph',
            'password' => Hash::make('OUBSStaff01'),
            'role' => 'staff'
        ]);
    }
}