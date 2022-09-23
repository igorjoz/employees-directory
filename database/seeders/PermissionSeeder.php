<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Create the initial roles and permissions.
     *
     * @return void
     */
    public function run()
    {
        // * reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // * create permissions - users & departments
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'edit users']);
        Permission::create(['name' => 'delete users']);
        Permission::create(['name' => 'create departments']);
        Permission::create(['name' => 'edit departments']);
        Permission::create(['name' => 'delete departments']);

        // create roles and assign existing permissions
        $employeeRole = Role::create(['name' => 'employee']);

        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo('create users');
        $adminRole->givePermissionTo('edit users');
        $adminRole->givePermissionTo('delete users');
        $adminRole->givePermissionTo('create departments');
        $adminRole->givePermissionTo('edit departments');
        $adminRole->givePermissionTo('delete departments');

        // * Super-Admin role - gets all permissions via Gate::before rule; see AuthServiceProvider
        $superAdminRole = Role::create(['name' => 'Super-Admin']);
    }
}
