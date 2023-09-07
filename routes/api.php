<?php

use App\Http\Controllers\Api\V1\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1', 'as' => 'v1.'], function () {
    /*
     |--------------------------------------------------------------------------
     | Authentication API Starts
     |--------------------------------------------------------------------------
     */

    Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
        Route::controller('App\Http\Controllers\Api\V1\AuthController')->group(function () {
            Route::post('register', 'register')->name('register');
            Route::post('login', 'login')->name('login');

            Route::middleware('auth:sanctum')->group(function () {
                Route::post('logout', 'logout')->name('logout');
            });
        });
    });
    /*
       |--------------------------------------------------------------------------
       | Task API Starts
       |--------------------------------------------------------------------------
       */
    Route::middleware('auth:sanctum')->group(function () {
        Route::apiResource('tasks', \App\Http\Controllers\Api\V1\TaskController::class);
        Route::group(['prefix' => 'tasks', 'as' => 'tasks.'], function () {


        });
        Route::put('assign-task', [TaskController::class, 'assignUser'])->name('assign-task');

        Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
            Route::get('user-for-assign-task', [TaskController::class, 'getUsersForAssignTask']);
        });
        Route::get('/auth-user-tasks', [TaskController::class, 'authUserTask']);
    });
});

