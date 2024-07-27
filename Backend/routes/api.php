<?php

use App\Http\Controllers\Auth\RegisteredUserController;
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

Route::post('register',[RegisteredUserController::class,'store']);
Route::post('login',[RegisteredUserController::class,'login']);
Route::get('home',[\App\Http\Controllers\HomeController::class,'home']);
Route::get('show/{id}',[\App\Http\Controllers\HomeController::class,'show']);

Route::group(['middleware' => ['auth:sanctum']],function (){

    Route::apiResource('artistes',\App\Http\Controllers\api\ArtisteController::class);
    Route::get('users', [RegisteredUserController::class,'index']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
