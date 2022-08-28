<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticalController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\EmailVerifiyController;
use App\Http\Controllers\Auth\RessetPasswordController;
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
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TeacherController;
use App\Mail\ResetUserPassword;
use App\Models\Admin;
use App\Models\Artical;
use App\Models\Country;
use App\Models\QsCompleteLatter;
use App\Models\Subscription;
use Illuminate\Mail\Markdown;
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
        Route::get('/forgot',[RessetPasswordController::class , 'showForgot'])->name('auth.forgot');
        Route::post('/reset',[RessetPasswordController::class , 'sendLinkReset'])->name('auth.reset');
        Route::get('/reset-password/{token}',[RessetPasswordController::class , 'showResetPassword'])->name('password.reset');
        Route::post('/reset-password',[RessetPasswordController::class , 'resetPassword'])->name('auth.reset_password');
    });

    Route::middleware('auth:admin')->group(function(){
        Route::get('/verifiy-email',[EmailVerifiyController::class , 'showVerifiyEmail'])->name('verification.notice');
        Route::get('/verifiy/{id}/{hash}',[EmailVerifiyController::class , 'verifiyEmail'])->name('verification.verify');
        Route::post('/send-verifiy',[EmailVerifiyController::class , 'sendVerifiyEmail'])->middleware('throttle:1,1')->name('verification.send');
    });


    /// -------------------- Auth Routes -------------

    Route::middleware('auth:admin','verified')->group(function(){
        // ----- Global Settings Route ---------
        Route::post('logout', [AuthController::class , 'logoutUser'])->name('auth.logout');
        Route::get('/',[HomeController::class , 'index'])->name('home.index');
        Route::post('/set-local',[HomeController::class , 'setLocal'])->name('set_local');
        Route::post('/change-password',[ChangePasswordController::class , 'changePassword'])->name('auth.change_password');


        // ----- Admin Controller Route ---------
        Route::post('/admins/status/{admin}',[AdminController::class , 'changeStatus'])->name('admins.change_status');
        Route::get('/admins/notification',[AdminController::class , 'showNotification'])->name('admins.notification');
        Route::post('/admins/notification/read',[AdminController::class , 'readNotification'])->name('admins.read_notification');
        
        Route::get('/admins/{admin}/permission/edit',[AdminController::class , 'editUserPermission'])->name('admins.permissions');
        Route::put('/admins/{admin}/permission/update',[AdminController::class , 'updateUserPermission'])->name('admins.update_permissions');
        Route::resource('admins',AdminController::class);

        // ----- Country Controller Route ---------
        Route::post('/countries/status/{country}',[CountryController::class , 'changeStatus'])->name('countries.change_status');
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
        Route::post('/semesters/status/{semester}',[SemesterController::class , 'changeStatus'])->name('semesters.change_status');
        Route::resource('semesters',SemesterController::class);

        // ----- Children Controller Route ---------
        Route::post('/childrens/status/{children}',[ChildrenController::class , 'changeStatus'])->name('childrens.change_status');
        Route::get('/childrens/{children}/anlytics',[ChildrenController::class ,'getAnlyt'])->name('childrens.anlytics');
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

        // ----- Subscriptions Controller Route ---------
        Route::post('/subscriptions/getChildrens',[SubscriptionController::class , 'getChildrens']);
        Route::delete('/subscriptions/change-subs',[SubscriptionController::class , 'changeSubs']);
        Route::resource('subscriptions',SubscriptionController::class);

        // ----- Articals Controller Route ---------
        Route::resource('articals',ArticalController::class);

        

    });

    
});





