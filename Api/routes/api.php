<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
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
Route::post('/users',[UserController::class, 'store']);


Route::post('/products/find',[ProductController::class, 'find']);
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::middleware('auth:sanctum')->post('/products',[ProductController::class,'store']);
Route::middleware('auth:sanctum')->put('/products/{id}',[ProductController::class,'update']);
Route::middleware('auth:sanctum')->delete('/products/{id}',[ProductController::class,'destroy']);
Route::middleware('auth:sanctum')->post('/logout',[AuthController::class,'logout']);
//Route::resource('products', ProductController::class);
//Route::get('/products/search/{name}',[ProductController::class, 'search']);

Route::middleware('auth:sanctum')->get('/products/search/{name}',[ProductController::class, 'search']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
