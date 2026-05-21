<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonorController;
use App\Http\Controllers\Admin\BloodGroupController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\DonorListController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\ProfileController as UserProfileController;
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

// Frontend Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::get('/donors', [DonorListController::class, 'index'])->name('donors.list');
Route::get('/donors/create', [DonorListController::class, 'create'])->name('donors.create');
Route::post('/donors', [DonorListController::class, 'store'])->name('donors.store');
Route::get('/donors/{donor}/edit', [DonorListController::class, 'edit'])->name('donors.edit');
Route::put('/donors/{donor}', [DonorListController::class, 'update'])->name('donors.update');
Route::delete('/donors/{donor}', [DonorListController::class, 'destroy'])->name('donors.destroy');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Authentication Routes (provided by Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [UserProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/donors', DonorController::class);
    Route::resource('/blood-groups', BloodGroupController::class);
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

require __DIR__.'/auth.php';
