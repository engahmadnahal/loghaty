<?php

namespace Database\Seeders;

use App\Models\Admin;
use Database\Factories\AdminFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::factory(1)->create();
        $this->givPermission();
        
    }

    public function givPermission(){
        $admin = Admin::find(1);
        $prs = Permission::all();
        $allPer = [];
        foreach($prs as $pr){
            array_push($allPer,$pr->name);
        }
        $admin->givePermissionTo($allPer);

    }
}
