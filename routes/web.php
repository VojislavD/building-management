<?php

use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Buildings
    Route::prefix('/buildings')->name('buildings.')->group(function() {
        Route::get('/', [BuildingController::class, 'index'])->name('index');
        Route::get('/create', [BuildingController::class, 'create'])->name('create');
        Route::get('/edit/{building}', [BuildingController::class, 'edit'])->name('edit');
        Route::delete('/delete/{building}', [BuildingController::class, 'destroy'])->name('delete');
        Route::get('/{building}', [BuildingController::class, 'show'])->name('show');
    });

    // Apartments
    Route::prefix('/apartments')->name('apartments.')->group(function() {
        Route::get('/', [ApartmentController::class, 'index'])->name('index');
        Route::get('/create/{building}', [ApartmentController::class, 'create'])->name('create');
        Route::get('/edit/{apartment}', [ApartmentController::class, 'edit'])->name('edit');
        Route::delete('/delete/{apartment}', [ApartmentController::class, 'destroy'])->name('delete');
    });

    // Tasks
    Route::prefix('/tasks')->name('tasks.')->group(function() {
        Route::get('/', [TaskController::class, 'index'])->name('index');
        Route::patch('/completed/{task}', [TaskController::class, 'completed'])->name('completed');
        Route::patch('/cancelled/{task}', [TaskController::class, 'cancelled'])->name('cancelled');
    });
});