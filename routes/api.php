<?php

use App\Http\Controllers\Api\Auth\AuthForgotPasswordController;
use App\Http\Controllers\Api\Auth\AuthLoginController;
use App\Http\Controllers\Api\FatherController;
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
            
        });
    });

});

