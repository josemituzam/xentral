<?php

namespace Database\Seeders\tenant;

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
            'company_read',
            'company_create',
            'company_edit',
            'company_destroy',

            'dashboard_read',
            'dashboard_create',
            'dashboard_edit',
            'dashboard_destroy',

            'permission_read',
            'permission_create',
            'permission_edit',
            'permission_destroy',

            'role_read',
            'role_create',
            'role_edit',
            'role_destroy',

            'user_read',
            'user_create',
            'user_edit',
            'user_destroy',

            //ISP 

            //Customer
            'customer_read',
            'customer_create',
            'customer_edit',
            'customer_destroy',

            //Contract
            'contract_read',
            'contract_create',
            'contract_edit',
            'contract_destroy',

            //Plan
            'plan_read',
            'plan_create',
            'plan_edit',
            'plan_destroy',

            //Sector
            'sector_read',
            'sector_create',
            'sector_edit',
            'sector_destroy',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'apiTenant'
            ]);
        }

        Role::create(['guard_name' => 'apiTenant', 'name' => 'Administrador', 'description' => 'Rol supervisor', 'icon' => 'DatabaseIcon', 'class' => 'primary']);

        /*    $supervisorPermissions = [
            'company_read',
            'company_create',
            'company_edit',
            'company_destroy',

            'dashboard_read',
            'dashboard_create',
            'dashboard_edit',
            'dashboard_destroy',
        ];

        foreach ($supervisorPermissions as $permission) {
            $supervisor->givePermissionTo($permission);
        } */


        Role::create(['guard_name' => 'apiTenant', 'name' => 'Supervisor', 'description' => 'Rol supervisor', 'icon' => 'UserIcon', 'class' => 'success']);

        /*  $generalPermissions = [
            'dashboard_read',
            'dashboard_create',
            'dashboard_edit',
            'dashboard_destroy',
        ];

        foreach ($generalPermissions as $permission) {
            $general->givePermissionTo($permission);
        }*/
    }
}
