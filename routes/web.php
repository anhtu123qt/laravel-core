<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::group([
    'middleware' => 'auth',
    'prefix' => 'admin'
], function () {
    Route::resource('posts', PostController::class);
    Route::get('posts/active-post/{id}', [PostController::class, 'activePost'])->name('posts.active');
    Route::resource('users', UserController::class);
    Route::get('dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
});
require __DIR__.'/auth.php';
