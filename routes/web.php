<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])
    ->name('home.index');

Route::get('/uzytkownicy', [UserController::class, 'index'])
    ->name('user.index');

Route::get('/dzial', [DepartmentController::class, 'index'])
    ->name('department.index');

Auth::routes([
    'register' => false,
]);
