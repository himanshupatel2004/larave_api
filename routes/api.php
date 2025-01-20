<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\AppController;
use App\Http\Controllers\UserApiController;





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


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('createUser', [UserController::class, 'createUser']);

Route::put('updateUser/{id}', [UserController::class, 'updateUser']);
Route::delete('deleteUser/{id}', [UserController::class, 'deleteUser']);

Route::post('login', [UserController::class, 'login']);

Route::get('unauthenticate', [UserController::class, 'unauthenticate'])->name('unauthenticate');


Route::middleware('auth:api')->group(function(){
    Route::get('getUsers', [UserController::class, 'getUsers']);
    Route::get('getUsersDetail/{id}', [UserController::class, 'getUsersDetail']);

    Route::get('index', [AppController::class, 'index']);

    Route::post('logout', [UserController::class, 'logout']);

});



Route::get('user/list', [UserApiController::class, 'index']);
Route::post('user/store', [UserApiController::class, 'store']);
Route::post('user/update/{id}', [UserApiController::class, 'update']);
Route::get('user/delete/{id}', [UserApiController::class, 'delete']);





