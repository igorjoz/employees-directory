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

// * check is user is logged in
Route::middleware(['auth'])->group(function () {
    Route::group(['middleware' => ['can:delete users']], function () {
        Route::resource('user', UserController::class);
        Route::resource('department', DepartmentController::class);
    });

    Route::get('/', [HomeController::class, 'index'])
        ->name('home.index');

    Route::resource('user', UserController::class, [
        'only' => ['index', 'show',]
    ]);
    Route::get('edytuj-konto', [UserController::class, 'edit'])
        ->name('user.edit_account');
    Route::put('edytuj-konto', [UserController::class, 'update'])
        ->name('user.update_account');

    Route::resource('department', DepartmentController::class, [
        'only' => ['index', 'show',]
    ]);
});
