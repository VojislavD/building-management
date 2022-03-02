<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApartmentController;
use App\Http\Controllers\BuildingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProjectController;
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

Route::redirect('/', '/dashboard');

Route::middleware(['auth:sanctum', 'verified'])->group(function() {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    // Buildings
    Route::controller(BuildingController::class)->prefix('/buildings')->name('buildings.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
        Route::get('/edit/{building}', 'edit')->name('edit');
        Route::delete('/delete/{building}', 'destroy')->name('delete');
        Route::get('/{building}', 'show')->name('show');
    });

    // Apartments
    Route::controller(ApartmentController::class)->prefix('/apartments')->name('apartments.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/create/{building}', 'create')->name('create');
        Route::get('/edit/{apartment}', 'edit')->name('edit');
        Route::delete('/delete/{apartment}', 'destroy')->name('delete');
    });

    // Tasks
    Route::controller(TaskController::class)->prefix('/tasks')->name('tasks.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/show/{task}', 'show')->name('show');
        Route::patch('/update/{task}', 'update')->name('update');
        Route::patch('/completed/{task}', 'completed')->name('completed');
        Route::patch('/cancelled/{task}', 'cancelled')->name('cancelled');
    });

    // Projects
    Route::controller(ProjectController::class)->prefix('/projects')->name('projects.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/edit/{project}', 'edit')->name('edit');
        Route::delete('/delete/{project}', 'destroy')->name('delete');
    });

    // Notifications
    Route::controller(NotificationController::class)->prefix('/notifications')->name('notifications.')->group(function() {
        Route::get('/index', 'index')->name('index');
        Route::get('/create/{building}', 'create')->name('create');
        Route::get('/show/{notification}', 'show')->name('show');
        Route::patch('/cancel/{notification}', 'cancel')->name('cancel');
        Route::delete('/delete/{notification}', 'destroy')->name('delete');
    });

    // Admins
    Route::controller(AdminController::class)->prefix('/admins')->name('admins.')->group(function () {
        Route::get('/index', 'index')->name('index');
        Route::get('/create', 'create')->name('create');
    });
});
