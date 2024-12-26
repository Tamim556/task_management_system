<?php

use App\Http\Controllers\Backend\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/tasks', [TaskController::class, 'getAllTasks']);