<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuItemController as AdminMenuItemController;
use App\Http\Controllers\Admin\ReservationController as AdminReservationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TableController as AdmintableController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');


// Menu routes
Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/menu/{menuItem}', [MenuController::class, 'show'])->name('menu.show');

// Reservation routes
Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/reservations/{reservation}/confirmed', [ReservationController::class, 'confirmed'])->name('reservations.confirmed');

// Authentication routes - already provided by Laravel Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard with both route names
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    // Admin routes group
    Route::prefix('admin')->name('admin.')->group(function () {
        // Admin menu management
        Route::resource('menu-items', AdminMenuItemController::class);

        // Bulk update route for reservations
        Route::post('/reservations/bulk-update', [AdminReservationController::class, 'bulkUpdate'])
             ->name('reservations.bulk-update');

        // Export reservations to CSV
        Route::get('/reservations/export', [AdminReservationController::class, 'export'])
             ->name('reservations.export');

        // Tables Management
        Route::resource('tables', AdmintableController::class);

        // Categories Management
        Route::resource('categories', CategoryController::class);

        // Menu Items Management
        Route::get('menu-items/export', [AdminMenuItemController::class, 'export'])
             ->name('menu-items.export');
        Route::resource('menu-items', AdminMenuItemController::class);

        // Admin reservation management
        Route::resource('reservations', AdminReservationController::class);
    });
});

require __DIR__.'/auth.php';
