<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
   public function run(): void
{
    \App\Models\User::updateOrCreate(
        ['staff_id' => 'STAFF123'], // <--- This is your "Matric No / Staff ID" field
        [
            'name' => 'Admin User',
            'email' => 'admin@shareameal.com',
            'password' => bcrypt('password123'), // <--- This is your password
            'is_admin' => true,
            'matric_no' => null,
        ]
    );
}


}
