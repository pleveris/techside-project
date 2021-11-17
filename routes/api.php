<?php

use App\Http\Controllers\Api\v1\BookController;
use App\Http\Controllers\Api\v1\ReviewController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1/'],function(){
    Route::apiResource('books', BookController::class)->only('index', 'show');

    Route::get('reviews/{book}',[ReviewController::class, 'index']);
    Route::get('reviews/average/{book}', [ReviewController::class, 'getAvg']);

    Route::group(['middleware' => 'auth:sanctum'],function(){
        Route::post('reviews/store/{book}',[ReviewController::class, 'store']);
    });
});



