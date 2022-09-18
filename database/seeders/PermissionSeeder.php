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

        





        // Permission::create(['guard_name'=>'','name' => 'Create-']);
        // Permission::create(['guard_name'=>'','name' => 'Update-']);
        // Permission::create(['guard_name'=>'','name' => 'Delete-']);
        // Permission::create(['guard_name'=>'','name' => 'Show-']);
    }
}
