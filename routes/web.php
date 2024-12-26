<?php

use App\Http\Controllers\Backend\TaskController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect(route('admin.task.index'));
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {

    Route::get('/task/index', [TaskController::class, 'index'])->name('task.index');
    Route::get('/task/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('/task/store', [TaskController::class, 'store'])->name('task.store');
    Route::get('/task/edit/{task}', [TaskController::class, 'edit'])->name('task.edit');
    Route::get('/task/show/{task}', [TaskController::class, 'show'])->name('task.show');
    Route::post('/task/update', [TaskController::class, 'update'])->name('task.update');
    Route::any('task/{task}/delete',[TaskController::class,'delete'])->name('task.delete');
    Route::any('/task/search',[TaskController::class,'search'])->name('task.search');
    Route::post('/task/update-status', [TaskController::class, 'updateStatus'])->name('task.status');
    Route::post('/task/image',[TaskController::class,'uploadImage'])->name('image.upload');




});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
