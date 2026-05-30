<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonorController;
use App\Http\Controllers\Admin\BloodGroupController;
use App\Http\Controllers\Admin\FooterSettingController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\DonorListController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController as UserProfileController;
use App\Http\Controllers\SliderController;
use App\Models\FooterSetting;
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
    // Route::get('/donors/create', [DonorListController::class, 'create'])->name('donors.create');
    // Route::post('/donors', [DonorListController::class, 'store'])->name('donors.store');
    // Route::get('/donors/{donor}/edit', [DonorListController::class, 'edit'])->name('donors.edit');
    // Route::put('/donors/{donor}', [DonorListController::class, 'update'])->name('donors.update');
    // Route::delete('/donors/{donor}', [DonorListController::class, 'destroy'])->name('donors.destroy');
    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::get('/lang/{locale}', function ($locale) {

        if (in_array($locale, ['en', 'bn'])) {
            session(['locale' => $locale]);
        }

        return redirect()->back();
    })->name('lang.switch');

    //Member
    Route::get('/become-member', [MemberController::class, 'create'])->name('member.create');
    Route::post('/become-member', [MemberController::class, 'store'])->name('member.store');
        
    //page
    Route::get('/page/{slug}', [PageController::class, 'show'])
        ->name('page.show');

    // Authentication Routes (provided by Breeze)
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [UserProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [UserProfileController::class, 'destroy'])->name('profile.destroy');
    });
    
    // Admin Routes
    Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

        //slider
        Route::get('/sliders', [SliderController::class, 'index'])->name('sliders.index');
        Route::get('/sliders/create', [SliderController::class, 'create'])->name('sliders.create');
        Route::post('/sliders', [SliderController::class, 'store'])->name('sliders.store');

        Route::get('/sliders/{slider}/edit', [SliderController::class, 'edit'])->name('sliders.edit');
        Route::put('/sliders/{slider}', [SliderController::class, 'update'])->name('sliders.update');

        Route::delete('/sliders/{slider}', [SliderController::class, 'destroy'])->name('sliders.destroy');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/donors', DonorController::class);
        Route::resource('/blood-groups', BloodGroupController::class);

        //setting
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
    
        // Admin profile routes
        Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::patch('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('admin.profile.update');

        //Page
        Route::get('/pages', [PageController::class, 'index'])
            ->name('pages.index');

        Route::get('/pages/create', [PageController::class, 'create'])
            ->name('pages.create');

        Route::post('/pages/store', [PageController::class, 'store'])
            ->name('pages.store');

        Route::get('/pages/{page}/edit', [PageController::class, 'edit'])
            ->name('pages.edit');

        Route::put('/pages/{page}', [PageController::class, 'update'])
            ->name('pages.update');

        Route::delete('/pages/{page}', [PageController::class, 'destroy'])
            ->name('pages.destroy');

        //Footer Setting
        Route::get('/footer-settings', [FooterSettingController::class, 'edit'])->name('footer.edit');
        Route::post('/footer-settings', [FooterSettingController::class, 'update'])->name('footer.update');

        //Member
        Route::get('/members', [MemberController::class, 'index'])->name('members.create');
        Route::get('/members/{id}/edit', [MemberController::class, 'edit'])->name('members.edit');
        Route::put('/members/{id}', [MemberController::class, 'update'])->name('members.update');
        Route::post('/members/{id}/approve', [MemberController::class, 'approve'])->name('members.approve');
        Route::post('/members/{id}/reject', [MemberController::class, 'reject'])->name('members.reject');
        Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('member.destory');
    });

require __DIR__.'/auth.php';