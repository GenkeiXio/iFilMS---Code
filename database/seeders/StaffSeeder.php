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
            'name' => 'Prince Louis Jaylo',
            'username' => 'jayloprincelouis123@gmail.com',
            'password' => Hash::make('plmj1101'),
        ]);
        
        staff::create([
            'name' => 'Prince Louis',
            'username' => 'plmj2022-6325-62187@bicol-u.edu.ph',
            'password' => Hash::make('plmj0121')
        ]);
    }
}