<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

// * Authentication
Auth::routes([
    'register' => false,
]);

Route::get('/', [HomeController::class, 'index'])
    ->name('home.index');

// * user resource
Route::resource('user', UserController::class, [
    // 'except' => ['index', 'show', 'create', 'store'],
]);

Route::get('/dzial', [DepartmentController::class, 'index'])
    ->name('department.index');
