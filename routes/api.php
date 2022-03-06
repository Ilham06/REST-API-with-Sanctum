<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\StudentController;
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

// Route::middleware('auth:sanctum', function () {
//     Route::get('/logout', [AuthController::class, 'logout']);
// });
// 
Route::group(['middleware' => 'auth:sanctum'], function(){
    Route::post('/create', [StudentController::class, 'create']);
    Route::get('/show/{id}', [StudentController::class, 'show']);
    Route::post('/update/{id}', [StudentController::class, 'update']);
    Route::delete('/{id}', [StudentController::class, 'delete']);
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/', [AuthController::class, 'index']);
