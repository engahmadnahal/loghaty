<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\HomeController;
use App\Models\Admin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware('Local')->group(function(){

    Route::middleware('guest')->group(function(){
        Route::get('login', [AuthController::class , 'loginPage'])->name('auth.login_page');
        Route::post('/login', [AuthController::class , 'login'])->name('auth.login');
    });



    /// -------------------- Auth Routes -------------

    Route::middleware('auth:admin')->group(function(){
        // ----- Global Settings Route ---------
        Route::post('logout', [AuthController::class , 'logoutUser'])->name('auth.logout');
        Route::get('/',[HomeController::class , 'index'])->name('home.index');
        Route::post('/set-local',[HomeController::class , 'setLocal'])->name('set_local');


        // ----- Admin Controller Route ---------
        Route::post('/admins/status/{admin}',[AdminController::class , 'changeStatus'])->name('admins.change_status');
        Route::resource('admins',AdminController::class);



        // ----- Country Controller Route ---------
        Route::resource('countries',CountryController::class);

        

    });

    
});





