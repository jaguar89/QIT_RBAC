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
        $manageAdmins = Permission::create(['name' => 'manage-admins']);
        $dashboardAccess = Permission::create(['name' => 'dashboard-access']);
//        $manageProducts = Permission::create(['name' => 'manage-products']);
        $readProducts = Permission::create(['name' => 'read-products']);
        $createProducts = Permission::create(['name' => 'create-products']);
        $updateProducts = Permission::create(['name' => 'update-products']);
        $deleteProducts = Permission::create(['name' => 'delete-products']);
//        $manageCategories = Permission::create(['name' => 'manage-categories']);
        $readCategories = Permission::create(['name' => 'read-categories']);
        $createCategories = Permission::create(['name' => 'create-categories']);
        $updateCategories = Permission::create(['name' => 'update-categories']);
        $deleteCategories = Permission::create(['name' => 'delete-categories']);

        // Assign permissions to super-admin
        $superAdminRole->givePermissionTo([
            $manageAdmins,
            $dashboardAccess,
            $readProducts,
            $createProducts,
            $updateProducts,
            $deleteProducts,
            $readCategories,
            $createCategories,
            $updateCategories,
            $deleteCategories
        ]);


    }
}
