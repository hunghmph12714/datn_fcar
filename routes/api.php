<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\ProductController;
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
Route::post('login',[ProductController::class, 'postLogin']);
Route::post('laydulieutheongay',[DataController::class,'LayDuLieuTheoNgay']);
Route::get('products/{name}',[DataController::class,'searchproduct']);
Route::post('bieudo',[DataController::class,'bieudo']);
Route::post('bieudosuachua',[DataController::class,'bieudosuachua']);
Route::post('bieudoban',[DataController::class,'bieudoban']);
Route::post('searchproduct',[DataController::class,'searchproduct']);