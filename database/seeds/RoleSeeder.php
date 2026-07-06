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
    public function run() {
        $role1 = Role::create([
            'name'=> 'consulta',
            'slug' => 'consulta',
            'description' => 'Busquedas y consultas'
        ]); 
            //Sólo tendrá capacidad de leer, ningún dato puede ser podificado por éste, así como tampoco puede hacer reportes

        $role2 = Role::create([
            'name'=>'Administrador',
            'slug' => 'administrador',
            'description' => 'Administrador'
        ]);
            //Máxima autoridad en el sistema. Todos los permisos le son concedidos

        $role3 = Role::create([
            'name'=>'developer',
            'slug' => 'developer',
            'description' => 'Desarrollador del Sistema'
        ]);
            //Por fines del oficio, éste rol también está habilitado a todas las rutas

        $role4 = Role::create([
            'name'=>'Users admin',
            'slug' => 'usersadmin',
            'description' => 'Administrador de Usuarios'
        ]);
            //Está por encima de Roles User. Tiene la capacidad de crear, editar, eliminar y restaurar usuarios, 
            //así como también es capaz de editar roles; mas no posee acceso a las accionesde gestión de losotros administradores
        $role5 = Role::create([
            'name'=>'Roles Admin',
            'slug' => 'rolesadmin',
            'description' => 'Administrador de Roles'
        ]);
            //Sólo edita usuarios de manera genérica y reasigna roles

        $role6 = Role::create([
            'name'=>'Reporteador',
            'slug' => 'reporteador',
            'description' => 'Reporteador'
        ]);
            //Tiene permisos de consulta y de generar reportes de donadores, mas no de usuarios
        $role7 = Role::create([
            'name'=>'Unidades Admin',
            'slug' => 'unidadadmin',
            'description' => 'Administrador de unidades para los usuarios'
        ]);
            //Unidades es el equivalente al histórico de "ubicaciones", el cual fue cambiado por fines conceptuales

        $role8 = Role::create([
            'name'=> 'Instituciones Admin',
            'slug' => 'institucionesadmin',
            'description' => 'Administrador de instituciones para los usuarios'
        ]);

        $role9 = Role::create([
            'name' => 'inactivo',
            'slug' => 'inactivo',
            'description' => 'Permisos prohibidos'
        ]);
            //Instituciones es el equivalente al histórico de "dependencias", el cual fue cambiado por fines conceptuales

            
            //Sólo es válido para los roles ACTIVOS, el rol número 9 no forma parte
        $allRoles = [$role1, $role2, $role3, $role4, $role5, $role6, $role7, $role8];

            // Permisos. -> 05.Jul.2026. Varios han sido añadidos o modificados debido a la funcionalidad anterior del proyecto

            //Donadores CRUD
        Permission::create([
            'name'=>'Listar Donadores',
            'slug' => 'donadores.index',
            'description' => 'listar donadores'
        ])->syncRoles($allRoles);
        Permission::create([
            'name'=>'Mostrar Donador',
            'slug' => 'donadores.show',
            'description' => 'mostrar donador'
        ])->syncRoles([$role1, $role2, $role3, $role4, $role5, $role7, $role8]);
        Permission::create([
            'name'=>'Buscar Donadores',
            'slug' => 'donadores.search',
            'description' => 'buscar donadores'
        ])->syncRoles([$role1, $role2, $role3, $role4, $role5, $role7, $role8]);

            //Users
        Permission::create([
            'name'=>'Create User',
            'slug' => 'user.create',
            'description' => 'Permission to create user'
        ])->syncRoles([$role2, $role3, $role4]);
        Permission::create([
            'name'=>'Update User',
            'slug' => 'user.update',
            'description' => 'Permission to update user'
        ])->syncRoles([$role2, $role3, $role4]);
        Permission::create([
            'name'=>'Delete User',
            'slug' => 'user.delete',
            'description' => 'Permission to delete user'
        ])->syncRoles([$role2, $role3, $role4]);
        Permission::create([
            'name'=>'Show User',
            'slug' => 'user.show',
            'description' => 'Permission to show user'
        ])->syncRoles([$role2, $role3, $role4]);
        Permission::create([
            'name'=>'List Users',
            'slug' => 'user.index',
            'description' => 'Permission to list users'
        ])->syncRoles([$role2, $role3, $role4]);

            //Roles
        Permission::create([
            'name'=>'Atach roles to users',
            'slug' => 'users.atachRoles',
            'description' => 'Permission to add rol users'
        ])->syncRoles([$role2, $role3, $role4]);
        Permission::create([
            'name'=>'List Roles',
            'slug' => 'role.list',
            'description' => 'Permission to list roles'
        ])->syncRoles([$role2, $role3, $role5]);
        Permission::create([
            'name'=>'Create roles',
            'slug' => 'roles.create',
            'description' => 'Permission to create roles'
        ])->syncRoles([$role2, $role3, $role5]);
        Permission::create([
            'name'=>'Update roles',
            'slug' => 'role.update',
            'description' => 'Permission to update role'
        ])->syncRoles([$role2, $role3, $role5]);
        Permission::create([
            'name'=>'Delete role',
            'slug' => 'role.delete',
            'description' => 'Permission to delete roles'
        ])->syncRoles([$role2, $role3, $role5]);
        Permission::create([
            'name'=>'Show role',
            'slug' => 'role.show',
            'description' => 'Permission to show a role'
        ])->syncRoles([$role2, $role3, $role5]);

            //Instituciones
        Permission::create([
            'name'=>'List instituciones', //Se refiere a las dependencias
            'slug' => 'instituciones.index', //En vez de "list", se les colocará "index" para ser explícitos con el método
            'description' => 'Permission to read instituciones'
        ])->syncRoles([$role2, $role3, $role8]);
        Permission::create([
            'name'=>'Create instituciones',
            'slug' => 'instituciones.create',
            'description' => 'Permission to create instituciones'
        ])->syncRoles([$role2, $role3, $role8]);
        Permission::create([
            'name'=>'Update instituciones',
            'slug' => 'instituciones.update',
            'description' => 'Permission to update instituciones'
        ])->syncRoles([$role2, $role3, $role8]);
        Permission::create([
            'name'=>'Delete instituciones',
            'slug' => 'instituciones.delete',
            'description' => 'Permission to delete instituciones'
        ])->syncRoles([$role2, $role3, $role8]);
        Permission::create([
            'name'=>'Show institucion',
            'slug' => 'institucion.show',
            'description' => 'Permission to show an institucion'
        ])->syncRoles([$role2, $role3, $role8]);

            //Unidades
        Permission::create([
            'name'=>'List unidades', //Se refiere a las ubicaciones
            'slug' => 'unidades.index', //En vez de "list", se les colocará "index" para ser explícitos con el método
            'description' => 'Permission to read unidades'
        ])->syncRoles([$role2, $role3, $role7]);
        Permission::create([
            'name'=>'Create unidades',
            'slug' => 'unidades.create',
            'description' => 'Permission to create unidades'
        ])->syncRoles([$role2, $role3, $role7]);
        Permission::create([
            'name'=>'Update unidades',
            'slug' => 'unidades.update',
            'description' => 'Permission to update unidades'
        ])->syncRoles([$role2, $role3, $role7]);
        Permission::create([
            'name'=>'Delete unidades',
            'slug' => 'unidades.delete',
            'description' => 'Permission to delete unidades'
        ])->syncRoles([$role2, $role3, $role7]);
        Permission::create([
            'name'=>'Show unidad',
            'slug' => 'unidad.show',
            'description' => 'Permission to show an unidad'
        ])->syncRoles([$role2, $role3, $role7]);

            //Reporte de donadores -> Quedará eliminado y será reemplazado por los nuevos permisos
        // Permission::create([
        //     'name'=>'Reporte de donadores',
        //     'slug' => 'donador.report',
        //     'description' => 'Permission to generate a report'
        // ])->syncRoles([$role2, $role3]);


        /**     Roles añadidos    **/

        //General
        Permission::create([
            'name'=>'Dashboard',
            'slug' => 'content.dashboard',
            'description' => 'Permission to index'
        ])->syncRoles($allRoles);
        Permission::create([
            'name' => 'Components',
            'slug' => 'components',
            'description' => 'Permission to see the components'
        ])->syncRoles($allRoles);
        Permission::create([
            'name' => 'Documentation',
            'slug' => 'documentation',
            'description' => 'Permission to read Documentation'
        ])->syncRoles([$role2, $role3]);

            //Users
        Permission::create([
            'name' => 'Users restore',
            'slug' => 'user.restore',
            'description' => 'Permission to restore an user'
        ])->syncRoles([$role2, $role3]);
        Permission::create([
            'name' => 'Users novedades',
            'slug' => 'user.novedad',
            'description' => 'Permission to read novedades'
        ])->syncRoles([$role2, $role3]);

            //Reportes
        Permission::create([
            'name' => 'Reportes index',
            'slug' => 'report.index',
            'description' => 'Permission to read a report'
        ])->syncRoles([$role2, $role3, $role4, $role5, $role6, $role7, $role8]);
        Permission::create([
            'name' => 'Reportes export',
            'slug' => 'report.export',
            'description' => 'Permission to export a report'
        ])->syncRoles([$role2, $role3, $role6]);
        Permission::create([
            'name' => 'Reportes Usuarios Index',
            'slug' => 'reportUser.index',
            'description' => 'Permission to read a report user'
        ])->syncRoles([$role1, $role2, $role4, $role5]);
        Permission::create([
            'name' => 'Reportes Usuarios Export',
            'slug' => 'reportUser.export',
            'description' => 'Permission to export a report user'
        ])->syncRoles([$role1, $role2, $role4]);
        // Permission::create([
        //     'name'=>'Reportes Usuarios Eliminados',
        //     'slug' => '',
        //     'description' => ''
        // ])->assignRole($role1);      -> No sirve

             //Buscador -> Va en función de todos los métodos show
        Permission::create([
            'name' => 'Buscador index',
            'slug' => 'search',
            'description' => 'Permission to search'
            ])->syncRoles($allRoles);

            //Estadisticas
        Permission::create([
            'name' => 'Estadisticas index',
            'slug' => 'graphics',
            'description' => 'Permission to see graphics'
            ])->syncRoles($allRoles);

            //Permiso Denegado
        Permission::create([
            'name' => 'Prohibido',
            'slug' => 'prohibido',
            'description' => 'Permiso restrictivo'
        ])->assignRole($role9);
    }
}
