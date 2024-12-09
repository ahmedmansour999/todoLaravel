<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('todo-list.home');
})->name('home');


Route::get('lottie', function () {
    return view('todo_component.lottieEmpty');
});

Route::middleware('auth')->group(function () {

    Route::get('allTasks', [TaskController::class, "index"])->name('allTasks');;
    Route::post('add-task', [TaskController::class, "store"])->name('task.store');
    Route::post('update-task:{id}', [TaskController::class, "update"])->name('task.update');
    Route::get('deletedTask', [TaskController::class, 'getTrashedTask'])->name('task.deletedTask');
    Route::delete('softdeleteTask/{id}', [TaskController::class, 'softdelete'])->name('task.softdelete');
    Route::delete('deleteTask/{id}', [TaskController::class, 'delete'])->name('task.delete');
    Route::post('restoreTask/{id}', [TaskController::class, 'restore'])->name('task.restore');



    Route::get('category', [CategoryController::class, 'index'])->name('category.index');
    Route::post('add-category', [CategoryController::class, 'store'])->name('category.store');
    Route::post('update-category/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('deletedCategory', [CategoryController::class, 'getTrashedCategory'])->name('category.deletedCategory');
    Route::delete('softdeleteCat/{id}', [CategoryController::class, 'softdelete'])->name('category.softDelete');
    Route::delete('deleteCat/{id}', [CategoryController::class, 'delete'])->name('category.delete');
    Route::post('restoreCat/{id}', [CategoryController::class, 'restore'])->name('category.restore');
});
