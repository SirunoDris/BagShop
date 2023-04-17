<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BagController;
use App\Http\Controllers\Api\LoginController;

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


Route::post('login', [LoginController::class, 'login']);
Route::post('register', [LoginController::class, 'register']);
Route::post('logout', [LoginController::class, 'logout']);
Route::post('user', [LoginController::class, 'user']);

//Route::resource('/bags', BagController::class)->middleware(['auth:sanctum']);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::controller(BagController::class)->group(function(){
        Route::get('/bags','index');
        Route::post('/bags','create');
        Route::get('/bags/{id}','read');
        Route::post('/bags/edit','update');
        Route::delete('/bags/{id}','delete');
    });
});


