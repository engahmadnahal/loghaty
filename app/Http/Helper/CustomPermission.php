<?php 

namespace App\Http\Helper;

use Spatie\Permission\Models\Permission;

class CustomPermission {

    public static function admin(){

        return [
            // Key use For Route     Use For Localization
            [
                'name' => 'Admin',
                'create' => Permission::where('name','Create-admin')->first(),
                'update' => Permission::where('name','Update-admin')->first(),
                'delete' => Permission::where('name','Delete-admin')->first(),
                'read' => Permission::where('name','Read-admin')->first(),
            ] ,
             [
                'name' => 'Teacher',
                'create' => Permission::where('name','Create-teacher')->first(),
                'update' => Permission::where('name','Update-teacher')->first(),
                'delete' => Permission::where('name','Delete-teacher')->first(),
                'read' => Permission::where('name','Read-teacher')->first(),
            ] ,
            [
                'name' => 'Class',
                'create' => Permission::where('name','Create-class')->first(),
                'update' => Permission::where('name','Update-class')->first(),
                'delete' => Permission::where('name','Delete-class')->first(),
                'read' => Permission::where('name','Read-class')->first(),
            ]   , 
            [
                'name' => 'Qusstion',
                'create' => Permission::where('name','Create-qs')->first(),
                'update' => Permission::where('name','Update-qs')->first(),
                'delete' => Permission::where('name','Delete-qs')->first(),
                'read' => Permission::where('name','Read-qs')->first(),
            ] ,  
             [
                'name' => 'Game',
                'create' => Permission::where('name','Create-game')->first(),
                'update' => Permission::where('name','Update-game')->first(),
                'delete' => Permission::where('name','Delete-game')->first(),
                'read' => Permission::where('name','Read-game')->first(),
            ] , 
        ];

    }
}
