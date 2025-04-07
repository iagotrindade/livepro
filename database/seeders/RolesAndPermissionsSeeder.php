<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'financial' => ['createFinancial', 'viewFinancial', 'editFinancial', 'downloadFinancial', 'deleteFinancial'],
            'support' => ['createSupport', 'viewSupport', 'editSupport', 'downloadSupport', 'deleteSupport'],
            'docs' => ['createDocs', 'viewDocs', 'editDocs', 'downloadDocs', 'deleteDocs'],
            'services' => ['createServices', 'viewServices', 'editServices', 'downloadServices', 'deleteServices'],
            'marketing' => ['createMarketing', 'viewMarketing', 'editMarketing', 'downloadMarketing', 'deleteMarketing'],
            'permissions' => ['createPermissions', 'viewPermissions', 'editPermissions', 'downloadPermissions', 'deletePermissions'],
            'users' => ['createUsers', 'viewUsers', 'editUsers', 'downloadUsers', 'deleteUsers'],
            'audit' => ['createAudit', 'viewAudit', 'editAudit', 'downloadAudit', 'deleteAudit']
        ];

        foreach ($permissions as $group => $actions) {
            foreach ($actions as $action) {
                Permission::create(['name' => $action]);
            }
        }

        $roles = [
            'super-admin' => Permission::all(),
            'Gerente' => Permission::all(),
            'Financeiro' => $permissions['financial'],
            'Suporte' => $permissions['support'],
            'Validador de Documentos' => $permissions['docs'],
            'Marketing' => $permissions['marketing'],
            'Auditor' => $permissions['audit'],
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::create(['name' => $roleName])
                ->givePermissionTo($rolePermissions);
        }
    }
}
