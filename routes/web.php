<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CourseController;
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

Route::get('/dashboard',[CourseController::class, 'classesToday'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/toggle', [CourseController::class, 'toggle'])->name('handleToggle');
    Route::get('/course', [CourseController::class, 'create'])->name('course.create');
    Route::post('/store', [CourseController::class, 'store'])->name('course.store');
    Route::post('/update', [CourseController::class, 'update'])->name('course.update');
    Route::get('/remove', [CourseController::class, 'remove'])->name('course.remove');
});

require __DIR__.'/auth.php';
