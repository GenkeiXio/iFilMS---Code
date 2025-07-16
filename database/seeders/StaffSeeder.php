<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Staff; 

class StaffSeeder extends Seeder
{
    public function run()
    {
        Staff::create([
            'name' => 'Prince Louis',
            'username' => 'pl@bicol-u.edu.ph',
            'password' => Hash::make('Corgi_1101'),
        ]);

        Staff::create([
            'name' => 'Prince Jaylo',
            'username' => 'plmj@bicol-u.edu.ph',
            'password' => Hash::make('jaylo1101'),
        ]);
    }
}