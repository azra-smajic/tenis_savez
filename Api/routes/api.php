<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TennisAssociationController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});

Route::controller(UserController::class)->group(function () {
    Route::post('users', 'store');
    Route::post('users/find', 'find');
    Route::delete('users/{id}', 'destroy');
    Route::get('users/{id}', 'show');
    Route::put('users/{id}', 'update');
});

Route::controller(TennisAssociationController::class)->group(function () {
    Route::post('tennisAssociations', 'store');
    Route::post('tennisAssociations/find', 'find');
    Route::delete('tennisAssociations/{id}', 'destroy');
    Route::get('tennisAssociations/{id}', 'show');
    Route::put('tennisAssociations/{id}', 'update');
});
