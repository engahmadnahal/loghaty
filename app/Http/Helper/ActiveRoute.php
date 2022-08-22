<?php 

namespace App\Http\Helper;

use Illuminate\Support\Facades\Route;

class ActiveRoute {

    public static function isActive($routeName) : string{

        if(Route::currentRouteName() == $routeName){
            return 'active';

        }
        return '';
    }

}
