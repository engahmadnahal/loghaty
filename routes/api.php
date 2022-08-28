<?php

use App\Http\Controllers\Api\ArticalController;
use App\Http\Controllers\Api\Auth\AuthForgotPasswordController;
use App\Http\Controllers\Api\Auth\AuthLoginController;
use App\Http\Controllers\Api\ChildrenController;
use App\Http\Controllers\Api\FatherController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\SemesterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('Local')->group(function(){

    Route::middleware('guest')->prefix('v1')->group(function(){
        Route::post('/auth/father/register', [FatherController::class , 'register']);
        Route::post('/auth/login', [AuthLoginController::class , 'login']);
        Route::post('/auth/send-code', [AuthForgotPasswordController::class , 'sendEmailCode']);
        Route::post('/auth/check-code', [AuthForgotPasswordController::class , 'checkCode']);
        Route::post('/auth/reset', [AuthForgotPasswordController::class , 'resetPassword']);

    });
    

    
    
    /// ------- Auth Route
    Route::middleware('auth:api-techer,api-father')->prefix('v1')->group(function(){

        Route::controller(FatherController::class)->group(function(){

            Route::post('father/{father}/setting','sendSetting');
            Route::get('father/{father}/setting','getSetting');

            Route::get('father/{father}','getInfo');
            Route::post('father/{father}/edit','editInfo');
            Route::post('father/{father}/vist','sendVist');
            


        });

        Route::controller(PlanController::class)->group(function(){
            Route::get('plans','getPlans');
            Route::post('plans/{plan}','subsPlan');
            Route::post('subscription','addChildrenToSubs');

            Route::post('subscription/{father}/all','getAllChildrenSubs');
            Route::get('subscription/{children}','getSingleChildrenSubs');

            
            
        });

        Route::controller(SemesterController::class)->group(function(){
            Route::get('classes','getAllSemester');
            Route::get('classes/{semester}','getSingleSemester');
            Route::post('classes/{semester}/add','addChildToClass');
            Route::post('classes/create','createSemester');
        });

        Route::controller(ChildrenController::class)->group(function(){
            Route::get('childrens','getAllChildren');
            Route::get('childrens/{children}','getSingleChildren');
            Route::post('childrens/{children}/delete','deleteChildren');
            Route::post('childrens/add','addChildren');
            Route::post('childrens/{children}/progress','sendProgress');
            Route::get('childrens/{children}/progress','getProgress');
            Route::get('childrens/{children}/certificates','getCertificates');
            Route::post('childrens/{children}/history','sendHistory');
            Route::post('childrens/{children}/last-vist','sendDateLastVist');

        });

        Route::controller(ArticalController::class)->group(function(){
            Route::get('articals','getAllArtical');
            Route::get('articals/{artical}','getSingleArtical');
        });

    });

});

