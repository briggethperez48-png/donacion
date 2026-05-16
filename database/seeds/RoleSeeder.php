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

        Permission::create(['name'=>'Dashboard'])
            ->syncRoles([$role1, $role2, $role3, $role4]);

            //Donantes
        Permission::create(['name'=>'Donador index'])
            ->syncRoles([$role1, $role2, $role3, $role4]);
        Permission::create(['name'=>'Donador edit'])
            ->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name'=>'Donador destroy'])
            ->syncRoles([$role1, $role2, $role3]);

            //Users
        Permission::create(['name'=>'Users index'])
            ->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name'=>'Users create'])
            ->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'Users edit'])
            ->syncRoles([$role1, $role2]);
        Permission::create(['name'=>'Users destroy'])
            ->syncRoles([$role1, $role2]);

            //Reportes
        Permission::create(['name'=>'Reportes index'])
            ->syncRoles([$role1, $role2, $role3]);
        Permission::create(['name'=>'Reportes export'])
            ->syncRoles([$role1, $role2, $role3]);

             //Buscador
        Permission::create(['name'=>'Buscador index'])
            ->syncRoles([$role1, $role2, $role3, $role4]);

            //Estadisticas
        Permission::create(['name'=>'Estadisticas index'])
            ->syncRoles([$role1, $role2, $role3, $role4]);
    }
}
