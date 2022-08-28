<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::resource('categories', App\Http\Controllers\CategoryController::class);
    //Route::get('categories/{id}/articles', [App\Http\Controllers\ArticleController::class, 'index'])->name('articles.index');
});

Route::middleware(['auth'])->group(function () {
    Route::resource('articles', App\Http\Controllers\ArticleController::class);
});

