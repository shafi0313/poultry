<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RoleToPermission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $pers = [
            'dashboard'=>[
                'access-dashboard',
                'dashboard-manage',
            ],
            'user'=>[
                'user-manage',
                'user-add',
                'user-edit',
                'user-delete',
                'user-impersonate',
                'user-access-dashboard',
            ],
            'activity'=>[
                'activity-manage',
                'activity-add',
                'activity-edit',
                'activity-delete'
            ],
            'permission'=>[
                'permission-manage',
                'permission-add',
                'permission-edit',
                'permission-delete',
                'permission-change'
            ],
            'role'=>[
                'role-manage',
                'role-add',
                'role-edit',
                'role-delete',
                'role-change'
            ],
            'backup'=>[
                'backup-manage',
                'backup-delete'
            ],
            'visitor'=>[
                'visitor-manage',
                'visitor-delete'
            ],
            'setting'=>[
                'setting-manage',
                'language-manage',
            ],
            'employee-cat'=>[
                'employee-cat-manage',
                'employee-cat-add',
                'employee-cat-edit',
                'employee-cat-delete'
            ],
            'employee'=>[
                'employee-manage',
                'employee-add',
                'employee-edit',
                'employee-delete'
            ],
            'farm'=>[
                'farm-manage',
                'farm-add',
                'farm-edit',
                'farm-delete'
            ],
            'sub-farm'=>[
                'sub-farm-manage',
                'sub-farm-add',
                'sub-farm-edit',
                'sub-farm-delete'
            ],
        ];
        foreach ($pers as $per => $val) {
            foreach ($val as $name) {
                Permission::create([
                    'module'        => $per,
                    'name'          => $name,
                    'removable'     => 0,
                ]);
            }
        }


        // $superadmin = Role::create(['name' => 'superadmin','removable'=> 0]);
        $admin      = Role::create(['name' => 'admin','removable'=> 0]);
        $admin->givePermissionTo(Permission::all());
        $teacher    = Role::create(['name' => 'user','removable'=> 0]);
    }
}
