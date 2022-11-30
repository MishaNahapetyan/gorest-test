<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware(['auth', 'admins'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
        Route::get('/dashboard', \App\Http\Controllers\DashboardController::class)
            ->name('dashboard');

        Route::get('/posts/{id}', \App\Http\Controllers\PostController::class)
            ->name('posts');

        Route::get('/comments/{id}', \App\Http\Controllers\CommentsController::class)
            ->name('comments');
    });

require __DIR__.'/auth.php';
