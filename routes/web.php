<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ChildrenController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\FatherController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\QsCompleteLatterController;
use App\Http\Controllers\QsLatterBettweenWordController;
use App\Http\Controllers\QsOrderLatterController;
use App\Http\Controllers\QsPlayingController;
use App\Http\Controllers\TeacherController;
use App\Models\Admin;
use App\Models\QsCompleteLatter;
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

        // ----- teachers Controller Route ---------
        Route::post('/teachers/status/{teacher}',[TeacherController::class , 'changeStatus'])->name('teachers.change_status');
        Route::resource('teachers',TeacherController::class);

        // ----- fathers Controller Route ---------
        Route::post('/fathers/status/{father}',[FatherController::class , 'changeStatus'])->name('fathers.change_status');
        Route::resource('fathers',FatherController::class);

        // ----- plans Controller Route ---------
        Route::post('/plans/status/{plan}',[PlanController::class , 'changeStatus'])->name('plans.change_status');
        Route::resource('plans',PlanController::class);

        // ----- classes Controller Route ---------
        Route::post('/classes/status/{class}',[ClasseController::class , 'changeStatus'])->name('classes.change_status');
        Route::resource('classes',ClasseController::class);

        // ----- Children Controller Route ---------
        Route::post('/childrens/status/{children}',[ChildrenController::class , 'changeStatus'])->name('childrens.change_status');
        Route::resource('childrens',ChildrenController::class);

        // ----- Levels Controller Route ---------
        Route::post('/levels/status/{level}',[LevelController::class , 'changeStatus'])->name('levels.change_status');
        Route::resource('levels',LevelController::class);

        // ----- Game Controller Route ---------
        Route::post('/games/status/{game}',[GameController::class , 'changeStatus'])->name('games.change_status');
        Route::resource('games',GameController::class);

        // ----- QsCompleteLatter Controller Route ---------
        Route::resource('qs_complete_latters',QsCompleteLatterController::class);

        // ----- Qs_latter_bettween_words Controller Route ---------
        Route::resource('qs_latter_bettween_words',QsLatterBettweenWordController::class);

        // ----- qs_order_latters Controller Route ---------
        Route::resource('qs_order_latters',QsOrderLatterController::class);

        // ----- qs_playings Controller Route ---------
        Route::resource('qs_playings',QsPlayingController::class);

        

        

        

    });

    
});





