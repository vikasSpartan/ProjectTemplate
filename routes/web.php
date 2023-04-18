<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group(["middleware"=>'guest'], function(){
    Route::get('/', [AuthController::class, "index"] );
    Route::get('/login', [AuthController::class, "index"])->name('login');
    Route::post('loginUser', [AuthController::class, "loginUser"])->name('loginUser');
    
    Route::get('register', [AuthController::class, "registerView"])->name('register');
    Route::post('registerUser', [AuthController::class, "registerUser"])->name('registerUser');

    Route::get('forgotPassword', [AuthController::class, "fPasswordView"])->name('forgotPassword');
    Route::post('registerUser', [AuthController::class, "registerUser"])->name('registerUser');

    Route::post('sendFPassEmail', [AuthController::class, "sendFPassEmail"])->name('sendFPassEmail');
});

Route::group(["middleware"=>'auth'], function(){
    Route::get('/dashboard', [UserController::class, "dashboard"] );
    Route::get('/logout', [UserController::class, "logoutUser"] );
});