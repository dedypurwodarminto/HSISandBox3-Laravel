<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\UserController;
use App\Models\JenisBarang;

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
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/home', function () {
   return redirect('/');
});

Route::group(['middleware' => ['auth', 'roles:admin']], function () {
   //CRUD User
   Route::get('/user', [UserController::class, 'index']);
   Route::post('/user/store', [UserController::class, 'store']);
   Route::post('/user/update/{id}', [UserController::class, 'update']);
   Route::get('/user/destroy/{id}', [UserController::class, 'destroy']);
   
   //CRUD Jenis Barang
   Route::get('/jenisbarang', [JenisBarangController::class, 'index']);
   Route::post('/jenisbarang/store', [JenisBarangController::class, 'store']);
   Route::post('/jenisbarang/update/{id}', [JenisBarangController::class, 'update']);
   Route::get('/jenisbarang/destroy/{id}', [JenisBarangController::class, 'destroy']);
});

Route::group(['middleware' => ['auth', 'roles:admin,kasir']], function () {
   Route::get('/home', [HomeController::class, 'index']);
});
