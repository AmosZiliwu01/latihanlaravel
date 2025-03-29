<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

/*Login*/
Route::get('/login', [AuthController::class, 'index'])->name('auth.index');
Route::post('/login', [AuthController::class, 'verify'])->name('auth.verify');

/*Register*/
Route::get('/register', [AuthController::class, 'register'])->name('register.index');
Route::post('/register', [AuthController::class, 'registerProcess'])->name('registerProcess.index');
Route::get('/register/activation/{token}', [AuthController::class, 'registerVerify'])->name('register.activation');

Route::group(['middleware' => 'auth:user'],function (){
    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

        /*Category*/
        Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
        Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
        Route::post('/category/update{id}', [CategoryController::class, 'update'])->name('category.update');
        Route::post('/category/delete{id}', [CategoryController::class, 'delete'])->name('category.delete');
    });
});
