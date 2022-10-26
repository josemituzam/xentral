<?php

namespace Database\Seeders\Tenant;

use App\Models\Core\Auth\Permission;
use App\Models\Core\Auth\Role;
use Illuminate\Database\Seeder;
use Spatie\Permission\PermissionRegistrar;


class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // spatie documentation
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // gets all permissions via Gate::before rule; see AuthServiceProvider
        Role::create(['guard_name' => 'apiTenant', 'name' => 'Root', 'description' => 'Rol root', 'icon' => 'ServerIcon', 'class' => 'warning']);

        $permissions = [
            'company_index',
            'company_create',
            'company_edit',
            'company_destroy',

            'dashboard_index',
            'dashboard_create',
            'dashboard_edit',
            'dashboard_destroy',

            'permission_index',
            'permission_create',
            'permission_edit',
            'permission_destroy',

            'role_index',
            'role_create',
            'role_edit',
            'role_destroy',

            'user_index',
            'user_create',
            'user_edit',
            'user_destroy',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'apiTenant'
            ]);
        }

        $supervisor = Role::create(['guard_name' => 'apiTenant', 'name' => 'Administrador', 'description' => 'Rol supervisor', 'icon' => 'DatabaseIcon', 'class' => 'primary']);

        $supervisorPermissions = [
            'company_index',
            'company_create',
            'company_edit',
            'company_destroy',

            'dashboard_index',
            'dashboard_create',
            'dashboard_edit',
            'dashboard_destroy',
        ];

        foreach ($supervisorPermissions as $permission) {
            $supervisor->givePermissionTo($permission);
        }


        $general = Role::create(['guard_name' => 'apiTenant', 'name' => 'Supervisor', 'description' => 'Rol general', 'icon' => 'UserIcon', 'class' => 'success']);

        $generalPermissions = [
            'dashboard_index',
            'dashboard_create',
            'dashboard_edit',
            'dashboard_destroy',
        ];

        foreach ($generalPermissions as $permission) {
            $general->givePermissionTo($permission);
        }
    }
}
