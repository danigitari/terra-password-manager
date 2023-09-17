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
        Route::post('/addNewAdmin', [\App\Http\Controllers\AdminController::class, 'addNewAdmin']);

        Route::post('/createUsers', [\App\Http\Controllers\AdminController::class, 'createUsers']);
        Route::get('/getUsers', [\App\Http\Controllers\AdminController::class, 'getUsers']);
        Route::post('/editUser', [\App\Http\Controllers\AdminController::class, 'editUser']);
        Route::post('/deleteUser', [\App\Http\Controllers\AdminController::class, 'deleteUser']);
       
        Route::post('/createNewCredential', [\App\Http\Controllers\AdminController::class, 'createNewCredential']);
        Route::get('/getCredentials', [\App\Http\Controllers\AdminController::class, 'getCredentials']);
        Route::post('editCredential', [\App\Http\Controllers\AdminController::class, 'editCredential']);
        Route::post('deleteCredential', [\App\Http\Controllers\AdminController::class, 'deleteCredential']);

        Route::post('/createNewRole', [\App\Http\Controllers\AdminController::class, 'createNewRole']);
        Route::get('/getRoles', [\App\Http\Controllers\AdminController::class, 'getRoles']);
        Route::post('/deleteRole', [\App\Http\Controllers\AdminController::class, 'deleteRole']);
        Route::post('/editRole', [\App\Http\Controllers\AdminController::class, 'editRole']);
        Route::get('/getLogs', [\App\Http\Controllers\AdminController::class, 'getLogs']);
        
    });
    Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']);
    Route::post('/editProfile',[\App\Http\Controllers\AuthController::class, 'editProfile']);
    Route::get('/getCurrentUser', [\App\Http\Controllers\AuthController::class, 'getCurrentUser']);
    


    // Route::get('/getCredentials/{id}', [\App\Http\Controllers\UserController::class, 'getCredential']);
    
});
