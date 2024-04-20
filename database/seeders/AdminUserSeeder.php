<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = User::firstOrCreate([
            'email' => 'admin@mallow-tech.com'
        ], [
            'name' => 'Admin',
            'password' => Hash::make('password123'),
        ]);

    }
}
