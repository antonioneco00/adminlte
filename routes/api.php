<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/xlsx-json', 'App\Http\Controllers\HomeController@xlsx_json');

// Usuarios
Route::post('/users', 'App\Http\Controllers\UserController@save');
Route::delete('/users/{id}', 'App\Http\Controllers\UserController@delete');

// Tipos de eventos
Route::post('/event-types', 'App\Http\Controllers\EventTypeController@save');
Route::delete('/event-types/{id}', 'App\Http\Controllers\EventTypeController@delete');
