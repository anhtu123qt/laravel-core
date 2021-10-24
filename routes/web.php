<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

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
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::resource('posts', PostController::class);
    Route::get('posts/active-post/{id}', [PostController::class, 'activePost'])->name('posts.active');
    //Accessors
    Route::get('/accessors/{id}', [UserController::class, 'accessors']);
});
require __DIR__.'/auth.php';
