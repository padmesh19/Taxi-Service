<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Driver;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('roles')->truncate();

        $adminRole = Role::create([
            'name' => 'Admin',
        ]);

        $permissions = Permission::all();
        $adminRole->givePermissionTo($permissions);

        $customerRole = Role::create([
            'name' => 'Customer',
        ]);
        $customerRole->givePermissionTo(['customers.read', 'customers.write']);

        $driverRole = Role::create([
            'name' => 'Driver',
        ]);   
        $driverRole->givePermissionTo(['drivers.read', 'drivers.write']);    

        $users = User::all();
        
        foreach($users as $user){
            if($user['email'] == 'admin@mallow-tech.com'){
                $user->assignRole(['Admin']);
                }
        }

        User::where('email', '!=', 'admin@mallow-tech.com')->chunkById(500, function ($users) {
            $customers = Customer::all();
            $drivers = Driver::all();
            foreach ($users as $user) {
                foreach ($customers as $customer) {
                    if($customer['user_id'] == $user['id']){
                        $user->assignRole(['Customer']);
                    }
                }
                foreach ($drivers as $driver) {
                    if($driver['user_id'] == $user['id']){
                        $user->assignRole(['Driver']);
                    }
                }
            }
        });
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $this->command->info('Completed roles table seeder');
    }
}
