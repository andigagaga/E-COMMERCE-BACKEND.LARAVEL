<?php

use App\Http\Controllers\API\FoodController;
use App\Http\Controllers\API\MidtransController;
use App\Http\Controllers\API\TransactionController;
use App\Http\Controllers\API\UseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Jetstream\Rules\Role;

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

// route ketika sudah login
Route::middleware('auth:sanctum')->group(function(){
    Route::get('login', [UseController::class, 'fetch']);
    Route::post('user', [UseController::class, 'updateProfile']);
    Route::post('user/photo', [UseController::class, 'updatePhoto']);
    Route::post('logOut', [UseController::class, 'logOut']);

    Route::post('checkout', [TransactionController::class, 'checkout']);

    Route::get('transaction', [TransactionController::class,'all']);
    Route::post('transaction/{id}', [TransactionController::class, 'update']);
});

// ketikas belom login
Route::post('login', [UseController::class, 'login']);
Route::post('register', [UseController::class, 'register']);

// api food nya
Route::get('food', [FoodController::class, 'all']);


Route::post('midtrans/callback', [MidtransController::class, 'callback']);