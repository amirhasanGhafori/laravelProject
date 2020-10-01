<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $roleInDatabase = Role::where('name',config('permission.default_rules')[0]);
        if ($roleInDatabase)
        {
            foreach (config('permission.default_rules') as $role){
                Role::create([
                    'name'=>$role
                ]);
            }//foreach
        }//if


        $permissionInDatabase = Permission::where('name',config('permission.default_permission')[0]);
        if ($permissionInDatabase)
        {
            foreach (config('permission.default_permission') as $permission){
                Permission::create([
                    'name'=>$permission
                ]);
            }
        }//if


    }
}
