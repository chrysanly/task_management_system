<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubtaskController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/tasks', [TaskController::class, 'index'])->name('task.index');
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('task.create');
    Route::post('/tasks/store', [TaskController::class, 'store'])->name('task.store');
    Route::get('/tasks/show/{task}', [TaskController::class, 'show'])->name('task.show');
    Route::get('/tasks/edit/{task}', [TaskController::class, 'edit'])->name('task.edit');
    Route::patch('/tasks/update/{task}', [TaskController::class, 'update'])->name('task.update');
    Route::put('/tasks/trash/{task}', [TaskController::class, 'trash'])->name('task.trash');
    Route::delete('/tasks/destroy/{task}', [TaskController::class, 'destroy'])->name('task.destroy');
    Route::get('task/sub-tasks/{task}/create', [SubtaskController::class, 'create'])->name('task.subtask.create');
    Route::post('task/sub-tasks/store', [SubtaskController::class, 'store'])->name('task.subtask.store');
    Route::get('task/sub-tasks/edit/{subtask}', [SubtaskController::class, 'edit'])->name('task.subtask.edit');
    Route::patch('task/sub-tasks/update/{subtask}', [SubtaskController::class, 'update'])->name('task.subtask.update');
    Route::delete('task/sub-tasks/destroy/{subtask}', [SubtaskController::class, 'destroy'])->name('task.subtask.destroy');
});

require __DIR__.'/auth.php';
