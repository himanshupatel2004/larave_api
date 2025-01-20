<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\HomeController;


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

// Routeing Method
// get->view
// post->Store
// put->Store
// patch->Store/ Update
// delete->Delete

Route::get('/', function () {
    return view('login');
});

// Auth::routes();

Route::post('user/login', [LoginController::class, 'login'])->name('user.login');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('register', [RegisterController::class, 'register'])->name('register');
Route::post('user/register', [RegisterController::class, 'store'])->name('store');

Route::get('home', [HomeController::class, 'index'])->name('home');



// CRUD
Route::prefix('user/')->group(function () {
    Route::controller(UserController::class)->group(function () {
        Route::get('list', 'index'); // Read
        Route::post('store', 'store'); // store
        Route::get('create', 'create'); // Create
        Route::post('update', 'update'); // update
        Route::get('delete/{id}', 'delete'); // delete
        Route::get('edit/{id}', 'edit'); // edit
        Route::get('show/{id}', 'show');
        Route::get('search', 'search');
    });
});
