<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\KhsController;
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

    // student crud
    Route::post('/create', [StudentController::class, 'create']);
    Route::get('/show/{id}', [StudentController::class, 'show']);
    Route::post('/update/{id}', [StudentController::class, 'update']);
    Route::get('/{id}', [StudentController::class, 'delete']);

    // khs
    Route::post('khs/create', [KhsController::class, 'create']);
    Route::post('khs/update/{id}', [KhsController::class, 'update']);
    Route::post('khs/delete/{id}', [KhsController::class, 'delete']);

    // logout
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::post('/login', [AuthController::class, 'login']);
Route::get('/', [AuthController::class, 'index']);
