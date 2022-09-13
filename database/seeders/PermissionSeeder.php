<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $adminG = 1;
        // $teacherG = 2;
        // $classG = 3;
        // $gameG = 4;
        // $qsG = 5;
        // $levelG = 6;
        // $fatherG = 7;
        // $childrenG = 8;
        // $planG = 9;
        // $subscripG = 10;
        // $countryG = 11;
        // $articalG = 12;
        // $permissionG = 13;
        // $roleG = 14;
        //
        Permission::create(['guard_name'=>'admin','name' => 'Create-level']);
        Permission::create(['guard_name'=>'admin','name' => 'Update-level']);
        Permission::create(['guard_name'=>'admin','name' => 'Delete-level']);
        Permission::create(['guard_name'=>'admin','name' => 'Read-level']);

        Permission::create(['guard_name'=>'admin','name' => 'Create-game']);
        Permission::create(['guard_name'=>'admin','name' => 'Update-game']);
        Permission::create(['guard_name'=>'admin','name' => 'Delete-game']);
        Permission::create(['guard_name'=>'admin','name' => 'Read-game']);

        Permission::create(['guard_name'=>'admin','name' => 'Create-qs']);
        Permission::create(['guard_name'=>'admin','name' => 'Update-qs']);
        Permission::create(['guard_name'=>'admin','name' => 'Delete-qs']);
        Permission::create(['guard_name'=>'admin','name' => 'Read-qs']);

        Permission::create(['guard_name'=>'admin','name' => 'Create-semester']);
        Permission::create(['guard_name'=>'admin','name' => 'Update-semester']);
        Permission::create(['guard_name'=>'admin','name' => 'Delete-semester']);
        Permission::create(['guard_name'=>'admin','name' => 'Read-semester']);

        Permission::create(['guard_name'=>'admin','name' => 'Create-admin']);
        Permission::create(['guard_name'=>'admin','name' => 'Update-admin']);
        Permission::create(['guard_name'=>'admin','name' => 'Delete-admin']);
        Permission::create(['guard_name'=>'admin','name' => 'Read-admin']);


        Permission::create(['guard_name'=>'admin','name' => 'Create-teacher']);
        Permission::create(['guard_name'=>'admin','name' => 'Update-teacher']);
        Permission::create(['guard_name'=>'admin','name' => 'Delete-teacher']);
        Permission::create(['guard_name'=>'admin','name' => 'Read-teacher']);


        Permission::create(['guard_name'=>'admin','name' => 'Create-father']);
        Permission::create(['guard_name'=>'admin','name' => 'Update-father']);
        Permission::create(['guard_name'=>'admin','name' => 'Delete-father']);
        Permission::create(['guard_name'=>'admin','name' => 'Read-father']);

        Permission::create(['guard_name'=>'admin','name' => 'Create-children']);
        Permission::create(['guard_name'=>'admin','name' => 'Update-children']);
        Permission::create(['guard_name'=>'admin','name' => 'Delete-children']);
        Permission::create(['guard_name'=>'admin','name' => 'Read-children']);

        Permission::create(['guard_name'=>'admin','name' => 'Create-plan']);
        Permission::create(['guard_name'=>'admin','name' => 'Update-plan']);
        Permission::create(['guard_name'=>'admin','name' => 'Delete-plan']);
        Permission::create(['guard_name'=>'admin','name' => 'Read-plan']);

        Permission::create(['guard_name'=>'admin','name' => 'Create-subscrip',]);
        Permission::create(['guard_name'=>'admin','name' => 'Update-subscrip',]);
        Permission::create(['guard_name'=>'admin','name' => 'Delete-subscrip',]);
        Permission::create(['guard_name'=>'admin','name' => 'Read-subscrip',]);

        Permission::create(['guard_name'=>'admin','name' => 'Create-country',]);
        Permission::create(['guard_name'=>'admin','name' => 'Update-country',]);
        Permission::create(['guard_name'=>'admin','name' => 'Delete-country',]);
        Permission::create(['guard_name'=>'admin','name' => 'Read-country',]);

        Permission::create(['guard_name'=>'admin','name' => 'Create-artical']);
        Permission::create(['guard_name'=>'admin','name' => 'Update-artical']);
        Permission::create(['guard_name'=>'admin','name' => 'Delete-artical']);
        Permission::create(['guard_name'=>'admin','name' => 'Read-artical']);    




        Permission::create(['guard_name'=>'admin','name' => 'Create-role']);
        Permission::create(['guard_name'=>'admin','name' => 'Update-role']);
        Permission::create(['guard_name'=>'admin','name' => 'Delete-role']);
        Permission::create(['guard_name'=>'admin','name' => 'Read-role']);

        Permission::create(['guard_name'=>'admin','name' => 'giv_admin_permission']);
        Permission::create(['guard_name'=>'admin','name' => 'block_system']);
        Permission::create(['guard_name'=>'admin','name' => 'revers_notification']);

        Permission::create(['guard_name'=>'admin','name' => 'Delete-promotion']);
        Permission::create(['guard_name'=>'admin','name' => 'Read-promotion']);
        Permission::create(['guard_name'=>'admin','name' => 'Accept-promotion']);

        


        // Permission::create(['guard_name'=>'admin','name' => 'Create-level','group_permission_id' => $levelG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Update-level','group_permission_id' => $levelG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Delete-level','group_permission_id' => $levelG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Read-level','group_permission_id' => $levelG]);

        // Permission::create(['guard_name'=>'admin','name' => 'Create-game','group_permission_id' => $gameG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Update-game','group_permission_id' => $gameG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Delete-game','group_permission_id' => $gameG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Read-game','group_permission_id' => $gameG]);

        // Permission::create(['guard_name'=>'admin','name' => 'Create-qs','group_permission_id' => $qsG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Update-qs','group_permission_id' => $qsG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Delete-qs','group_permission_id' => $qsG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Read-qs','group_permission_id' => $qsG]);

        // Permission::create(['guard_name'=>'admin','name' => 'Create-class','group_permission_id' => $classG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Update-class','group_permission_id' => $classG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Delete-class','group_permission_id' => $classG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Read-class','group_permission_id' => $classG]);

        // Permission::create(['guard_name'=>'admin','name' => 'Create-admin','group_permission_id' => $adminG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Update-admin','group_permission_id' => $adminG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Delete-admin','group_permission_id' => $adminG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Read-admin','group_permission_id' => $adminG]);


        // Permission::create(['guard_name'=>'admin','name' => 'Create-teacher','group_permission_id' => $teacherG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Update-teacher','group_permission_id' => $teacherG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Delete-teacher','group_permission_id' => $teacherG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Read-teacher','group_permission_id' => $teacherG]);


        // Permission::create(['guard_name'=>'admin','name' => 'Create-father','group_permission_id' => $fatherG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Update-father','group_permission_id' => $fatherG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Delete-father','group_permission_id' => $fatherG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Read-father','group_permission_id' => $fatherG]);

        // Permission::create(['guard_name'=>'admin','name' => 'Create-children','group_permission_id' => $childrenG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Update-children','group_permission_id' => $childrenG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Delete-children','group_permission_id' => $childrenG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Read-children','group_permission_id' => $childrenG]);

        // Permission::create(['guard_name'=>'admin','name' => 'Create-plan','group_permission_id' => $planG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Update-plan','group_permission_id' => $planG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Delete-plan','group_permission_id' => $planG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Read-plan','group_permission_id' => $planG]);

        // Permission::create(['guard_name'=>'admin','name' => 'Create-subscrip','group_permission_id' => $subscripG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Update-subscrip','group_permission_id' => $subscripG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Delete-subscrip','group_permission_id' => $subscripG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Read-subscrip','group_permission_id' => $subscripG]);

        // Permission::create(['guard_name'=>'admin','name' => 'Create-country','group_permission_id' => $countryG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Update-country','group_permission_id' => $countryG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Delete-country','group_permission_id' => $countryG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Read-country','group_permission_id' => $countryG]);

        // Permission::create(['guard_name'=>'admin','name' => 'Create-artical','group_permission_id' => $articalG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Update-artical','group_permission_id' => $articalG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Delete-artical','group_permission_id' => $articalG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Read-artical','group_permission_id' => $articalG]);    


        // Permission::create(['guard_name'=>'admin','name' => 'Create-permission','group_permission_id' => $permissionG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Update-permission','group_permission_id' => $permissionG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Delete-permission','group_permission_id' => $permissionG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Read-permission','group_permission_id' => $permissionG]);

        // Permission::create(['guard_name'=>'admin','name' => 'Create-role','group_permission_id' => $roleG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Update-role','group_permission_id' => $roleG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Delete-role','group_permission_id' => $roleG]);
        // Permission::create(['guard_name'=>'admin','name' => 'Read-role','group_permiss




        // Permission::create(['guard_name'=>'','name' => 'Create-']);
        // Permission::create(['guard_name'=>'','name' => 'Update-']);
        // Permission::create(['guard_name'=>'','name' => 'Delete-']);
        // Permission::create(['guard_name'=>'','name' => 'Show-']);
    }
}
