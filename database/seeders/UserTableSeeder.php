<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory()->count(10)->create();
        foreach ($users as $user){
            Customer::create([
                'name' => $user->name,
                'email' => $user->email,
                'phone' => fake()->phoneNumber(10),
                'password' => $user->password,
                'user_id' => $user->id,
            ]);
        }
        $users = User::factory()->count(10)->create();
        foreach ($users as $user){
            Driver::create([
                'name' => $user->name,
                'email' => $user->email,
                'phone' => fake()->phoneNumber(10),
                'password' => $user->password,
                'location' => 'No Location Updated',
                'latitude' => 'No Location Updated',
                'longitude' => 'No Location Updated',
                'user_id' => $user->id,
            ]);
        }
    }
}
