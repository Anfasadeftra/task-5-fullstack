<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PassportAuthController;
use App\Http\Controllers\PostController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['cors', 'json.response']], function () {
    // ...
    // public routes
    Route::post('/login', 'App\Http\Controllers\Auth\ApiAuthController@login')->name('login.api');
    Route::post('/register','App\Http\Controllers\Auth\ApiAuthController@register')->name('register.api');
});

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', 'App\Http\Controllers\Auth\ApiAuthController@logout')->name('logout.api');
    Route::get('/articles', 'App\Http\Controllers\ArticleController@index')->middleware('api.admin')->name('articles');
    Route::resource('posts', PostController::class);
});

Route::group(['middleware' => 'VerifyAPIKey'], function () {
    Route::get('/v1/welcome', 'App\Http\Controllers\API\v1\WelcomeController@index');
});






