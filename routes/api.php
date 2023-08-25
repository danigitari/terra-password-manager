<?php

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

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);
Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['middleware' => ['role:admin']], function () {

        Route::post('/createUsers', [\App\Http\Controllers\AdminController::class, 'createUsers']);
        Route::post('/createNewCredential', [\App\Http\Controllers\AdminController::class, 'createNewCredential']);
        Route::post('/createNewRole', [\App\Http\Controllers\AdminController::class, 'createNewRole']);
        Route::get('/getUsers', [\App\Http\Controllers\AdminController::class, 'getUsers']);
        Route::get('/addNewAdmin', [\App\Http\Controllers\AdminController::class, 'addNewAdmin']);
        Route::get('/getCredentials', [\App\Http\Controllers\AdminController::class, 'getCredentials']);
        Route::get('/getRoles', [\App\Http\Controllers\AdminController::class, 'getRoles']);
        Route::post('/editUser', [\App\Http\Controllers\AdminController::class, 'editUser']);
        Route::delete('/deleteUser', [\App\Http\Controllers\AdminController::class, 'deleteUser']);
        
    });
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('/editProfile',[\App\Http\Controllers\AuthController::class, 'editProfile']);
    Route::get('/getCurrentUser', [\App\Http\Controllers\AuthController::class, 'getCurrentUser']);


    // Route::get('/getCredentials/{id}', [\App\Http\Controllers\UserController::class, 'getCredential']);
    
});
