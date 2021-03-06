<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissions extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        app()['cache']->forget('spatie.permission.cache');

        //Creacion de permisos sobre el crud del usuario
        Permission::create(['name' => 'create user']);
        Permission::create(['name' => 'read user']);
        Permission::create(['name' => 'update user']);
        Permission::create(['name' => 'delete user']);

        //Creacion de permisos sobre el crud del usuario
        Permission::create(['name' => 'create property']);
        Permission::create(['name' => 'read property']);
        Permission::create(['name' => 'update property']);
        Permission::create(['name' => 'delete property']);

        //Creacion de rol y asignacion de permisos al rol de "admin"
        $role = Role::create(['name' => 'admin']);
        //permisos CRUD de usuario, todos los permisos
        $role->givePermissionTo('create user');
        $role->givePermissionTo('read user');
        $role->givePermissionTo('update user');
        $role->givePermissionTo('delete user');
        $role->givePermissionTo('read property');

        //Creacion de rol y asignacion de permisos al rol de "hotel"
        $role = Role::create(['name' => 'hotel']);
        $role->givePermissionTo('create property');
        $role->givePermissionTo('read property');
        $role->givePermissionTo('update property');
        $role->givePermissionTo('delete property');

        //Creacion de rol y asignacion de permisos al rol de "tour"
        $role = Role::create(['name' => 'tour']);

        //Creacion de rol y asignacion de permisos al rol de "user"
        $role = Role::create(['name' => 'user']);
        $role->givePermissionTo('read property');


    }
}
