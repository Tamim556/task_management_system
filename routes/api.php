<?php

use App\Http\Controllers\Backend\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::get('/tasks', [TaskController::class, 'allTaskget']);

Route::get('/task/{id}', [TaskController::class, 'singleTask']);




