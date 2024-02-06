<?php

use App\Http\Controllers\TodoController;
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

Route::prefix('/todos')->group(function(){
    Route::get('/', [TodoController::class, 'index']);
    Route::get('/{todo}', [TodoController::class, 'show']);
    Route::post('/new-todo', [TodoController::class, 'store']);
    Route::post('/update/{todo}', [TodoController::class, 'update']);
    Route::post('/delete/{todo}', [TodoController::class, 'destroy']);
});
