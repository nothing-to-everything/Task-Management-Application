<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/tasks', [TaskController::class, 'index']);
    Route::post('/tasks', [TaskController::class, 'store']);
    Route::get('/tasks/{task}', [TaskController::class, 'show']);
    Route::put('/tasks/{task}', [TaskController::class, 'update']);
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy']);
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [AuthController::class, 'login']);
route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

