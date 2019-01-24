<?php

use Illuminate\Http\Request;

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

// Rutas api para las funciones de los usuarios
Route::prefix('users')->group(function() {
	Route::resource('/', 'UserController')->only([
		'index', 'edit', 'store', 'destroy'
	]);
	Route::put('/{id}', 'UserController@update')->name('update');
	Route::delete('/{id}', 'UserController@destroy')->name('destroy');
});
