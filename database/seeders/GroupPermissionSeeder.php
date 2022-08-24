<?php

namespace Database\Seeders;

use App\Models\GroupPermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GroupPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        GroupPermission::create(['name'=>'Admin']);
        GroupPermission::create(['name'=>'teacher']);
        GroupPermission::create(['name'=>'Class']);
        GroupPermission::create(['name'=>'Games']);
        GroupPermission::create(['name'=>'Question']);
        GroupPermission::create(['name'=>'Level']);
        GroupPermission::create(['name'=>'Game']);
        GroupPermission::create(['name'=>'Father']);
        GroupPermission::create(['name'=>'Children']);
        GroupPermission::create(['name'=>'Plan']);
        GroupPermission::create(['name'=>'Subscrip']);
        GroupPermission::create(['name'=>'Country']);
        GroupPermission::create(['name'=>'Artical']);
        GroupPermission::create(['name'=>'Permission']);
        GroupPermission::create(['name'=>'Role']);
        
        
    }
}
