<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;

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

//Login
Route::get('/', [AuthController::class, 'index']);
Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/home', function () {
   return redirect('/');
});

Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
   Route::get('/index', [HomeController::class, 'index']);
   Route::get('/home', [HomeController::class, 'index']);
});

Route::group(['middleware' => ['auth', 'checkRole:kasir']], function () {
   Route::get('/', [HomeController::class, 'index']);
   Route::get('/home', [HomeController::class, 'index']);
});
