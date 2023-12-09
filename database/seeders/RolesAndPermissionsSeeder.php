<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $superAdminRole = Role::create(['name' => 'super-admin']);
        $adminRole = Role::create(['name' => 'admin']);

        // Create permissions
        $manageAdminsPermission = Permission::create(['name' => 'manage-admins']);
        $dashboardAccessPermission = Permission::create(['name' => 'dashboard-access']);
        $manageProductsPermission = Permission::create(['name' => 'manage-products']);
        $manageCategoriesPermission = Permission::create(['name' => 'manage-categories']);

        // Assign permissions to roles
        $superAdminRole->givePermissionTo([
            $manageAdminsPermission,
            $dashboardAccessPermission,
            $manageProductsPermission,
            $manageCategoriesPermission,
        ]);

//        $adminRole->givePermissionTo([
//            $dashboardAccessPermission,
//            $manageProductsPermission,
//            $manageCategoriesPermission,
//        ]);

    }
}
