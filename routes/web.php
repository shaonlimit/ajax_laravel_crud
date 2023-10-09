<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [TaskController::class, 'index'])->name('task.index');
Route::post('/store', [TaskController::class, 'store'])->name('task.store');
Route::post('/update', [TaskController::class, 'update'])->name('task.update');
Route::post('/delete', [TaskController::class, 'delete'])->name('task.delete');
Route::post('/show', [TaskController::class, 'show'])->name('task.show');
Route::get('/pagination/paginate-data', [TaskController::class, 'pagination'])->name('task.pagination');
Route::get('/task_search', [TaskController::class, 'search'])->name('task.search');
