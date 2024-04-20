<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // reset cached roles and permissions
         app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

         //disable foreign key check for this connection before running seeders
         DB::statement('SET FOREIGN_KEY_CHECKS=0;');
 
         // remove all existing data and seeds a new data
         DB::table('permissions')->truncate();
 
         $permissions = [
             'customers.read',
             'customers.write',
             'drivers.read',
             'drivers.write',
             'roles.read',
             'roles.write',
         ];
         foreach ($permissions as $permission) {
             Permission::create([
                 'name' => $permission,
             ]);
         }
         // reset or enable foreign key checks
         DB::statement('SET FOREIGN_KEY_CHECKS=1;');
         $this->command->info('Completed permission table seeder');
    }
}
