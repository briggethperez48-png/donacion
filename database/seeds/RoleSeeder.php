<?php

use Illuminate\Database\Seeder;
use Aoo\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role1 = Role::create(['name'=>'SuperAdmin']);
        $role2 = Role::create(['name'=>'Admin']);
        $role3 = Role::create(['name'=>'Editor']);
        $role4 = Role::create(['name'=>'Reader']);

        Permission::create(['name'=>'Dashboard']);
    }
}
