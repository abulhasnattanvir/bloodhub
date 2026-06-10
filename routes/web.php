<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DonorController;
use App\Http\Controllers\Admin\BloodGroupController;
use App\Http\Controllers\Admin\CouncilController;
use App\Http\Controllers\Admin\FooterSettingController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SettingsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Frontend\GoalController;
use App\Http\Controllers\Admin\GoalController as AdminGoalController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SearchController;
use App\Http\Controllers\Frontend\DonorListController;
use App\Http\Controllers\Frontend\AboutController;
use App\Http\Controllers\Frontend\ActivityController;
use App\Http\Controllers\Admin\ActivityController as AdminActivityController;
use App\Http\Controllers\Admin\ContactMessageController;
use App\Http\Controllers\Admin\ContactSettingController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\FeeStructureController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\GreenInitiativeController;
use App\Http\Controllers\Admin\MemberFinanceController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserRoleController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogTagController;
use App\Http\Controllers\Frontend\BloodController;
use App\Http\Controllers\Frontend\ContactController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController as UserProfileController;
use App\Http\Controllers\SliderController;
use App\Models\FooterSetting;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\Rules\Can;

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
    Route::get('/blood', [BloodController::class, 'index'])->name('blood');
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
    Route::get('/members', [MemberController::class, 'frontendIndex'])->name('members.index');

    //Council
    Route::get('/council', [CouncilController::class, 'frontend'])->name('council.frontend');

    //Page
    Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');

    //Manual payment
    Route::get('/donation', [DonationController::class, 'create'])->name('donation.create');
    Route::post('/donation', [DonationController::class, 'store'])->name('donation.store');

    //Donation contributors
    Route::get('/donation-contributors', [DonationController::class, 'contributors'])->name('donation.contributors');


    // Frontend Activities (Post Type Style)
    Route::get('/activities', [ActivityController::class, 'index'])->name('activities.index');
    Route::get('/activities/{activity:slug}', [ActivityController::class, 'show'])->name('activities.show');

    //Goals
    Route::get('/goals', [GoalController::class, 'index'])->name('goals.index');
    Route::get('/goals/{goal}', [GoalController::class, 'show'])->name('goals.show');

    // USER PROFILE (Breeze)
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [UserProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [UserProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [UserProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Contact Form Submit
    Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

    //Frontend
    Route::get('/gallery', [AboutController::class, 'gallery'])->name('gallery');

    // Public Blog
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog.show');




//Admin Routes
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth'])
    ->group(function () {

        //Slider
        Route::middleware(['permission:slider.view'])->group(function () {
            Route::get('/sliders', [SliderController::class, 'index'])->name('sliders.index');
            Route::get('/sliders/create', [SliderController::class, 'create'])->name('sliders.create');
            Route::post('/sliders', [SliderController::class, 'store'])->name('sliders.store');
            Route::get('/sliders/{slider}/edit', [SliderController::class, 'edit'])->name('sliders.edit');
            Route::put('/sliders/{slider}', [SliderController::class, 'update'])->name('sliders.update');
            Route::delete('/sliders/{slider}', [SliderController::class, 'destroy'])->name('sliders.destroy');
        });

        //Dashboard
        Route::middleware(['permission:dashboard.view'])->group(function () {
            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        });
        
        //Blood groups
        Route::resource('/donors', DonorController::class)->middleware('permission:dashboard.view');
        Route::resource('/blood-groups', BloodGroupController::class)->middleware('permission:dashboard.view');

        //Setting
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index')->middleware('permission:dashboard.view');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update')->middleware('permission:dashboard.view');
    
        //Admin profile routes
        Route::get('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [App\Http\Controllers\Admin\ProfileController::class, 'update'])->name('profile.update');

        //Page
        Route::middleware(['permission:page.view'])->group(function () {
            Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
            Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
            Route::post('/pages/store', [PageController::class, 'store'])->name('pages.store');
            Route::get('/pages/{page}/edit', [PageController::class, 'edit'])->name('pages.edit');
            Route::put('/pages/{page}', [PageController::class, 'update'])->name('pages.update');
            Route::delete('/pages/{page}', [PageController::class, 'destroy'])->name('pages.destroy');
        });

        //Footer Setting
        Route::middleware(['permission:footer.edit'])->group(function () {
            Route::get('/footer/edit', [FooterSettingController::class, 'edit'])->name('footer.edit');
            Route::put('/footer/update', [FooterSettingController::class, 'update'])->name('footer.update');
            Route::post('/newsletter/subscribe', [FooterSettingController::class, 'subscribe'])->name('newsletter.subscribe');
        });
        
        //Member
        Route::get('/members', [MemberController::class, 'index'])->name('members.index');
        Route::get('/members/{id}/edit', [MemberController::class, 'edit'])->name('members.edit');
        Route::put('/members/{id}', [MemberController::class, 'update'])->name('members.update');
        Route::post('/members/{id}/approve', [MemberController::class, 'approve'])->name('members.approve');
        Route::post('/members/{id}/reject', [MemberController::class, 'reject'])->name('members.reject');
        Route::delete('/members/{id}', [MemberController::class, 'destroy'])->name('member.destory');

        //Council
        Route::get('/council', [CouncilController::class, 'index'])->name('council.index');
        Route::get('/council/create', [CouncilController::class, 'create'])->name('council.create');
        Route::post('/council', [CouncilController::class, 'store'])->name('council.store');
        Route::get('/council/{id}/edit', [CouncilController::class, 'edit'])->name('council.edit');
        Route::put('/council/{id}', [CouncilController::class, 'update'])->name('council.update');
        Route::delete('/council/{id}', [CouncilController::class, 'destroy'])->name('council.destroy');

        //Donation Payment 
        Route::middleware(['permission:donation.view'])->group(function () {
            Route::get('/donations', [DonationController::class, 'index'])->name('donations.index');
            Route::post('/donations/{id}/approve', [DonationController::class, 'approve'])->name('donations.approve');
            Route::post('/donations/{id}/reject', [DonationController::class, 'reject'])->name('donations.reject');
            Route::delete('/donations/{id}', [DonationController::class, 'destroy'])->name('donations.destroy');
        });

        //Menu Setting
        Route::middleware(['permission:contact.edit'])->group(function () {
            Route::resource('menus', MenuController::class);
            Route::post('/menus/sort', [MenuController::class, 'sort'])->name('menus.sort');
        });

        //Goals
        Route::resource('goals', AdminGoalController::class);

        //activaities
        Route::resource('activities', AdminActivityController::class);

        //Faq
        Route::resource('faqs', FaqController::class);

        //Contact settings
        Route::get('/contact/edit', [ContactSettingController::class, 'edit'])->name('contact.edit');
        Route::put('/contact/update', [ContactSettingController::class, 'update'])->name('contact.update');

        //Messages
        Route::get('/messages', [ContactMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{id}', [ContactMessageController::class, 'show'])->name('messages.show');
        Route::patch('/messages/{id}/read', [ContactMessageController::class, 'markAsRead'])->name('messages.mark-read');
        Route::delete('/messages/{id}', [ContactMessageController::class, 'destroy'])->name('messages.destroy');

        //Finance
        Route::get('/finance', [MemberFinanceController::class, 'index'])->name('finance.index')->middleware('role:Admin|Manager');
        Route::post('/finance/mark-paid/{id}', [MemberFinanceController::class, 'markPaid'])->name('finance.markPaid')->middleware('role:Admin|Manager');
        Route::get('/finance/member/{member}',[MemberFinanceController::class, 'show'])->name('finance.show')->middleware('role:Admin|Manager');
        Route::post('/payments',[PaymentController::class, 'store'])->name('payments.store')->middleware('role:Admin|Manager');

        //Fees
        Route::resource('fees',FeeStructureController::class);

        //gallery
        Route::resource('gallery', GalleryController::class)->names('gallery')->middleware('permission:dashboard.view');

        //green and video section
        Route::resource('green', GreenInitiativeController::class)
            ->parameters([
                'green' => 'greenInitiative'
            ]);
        Route::resource('videos', VideoController::class);

        //Blog
        Route::get('/blog', [BlogController::class, 'adminIndex'])->name('blog.index')->middleware('permission:dashboard.view');
        Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
        Route::post('/blog', [BlogController::class, 'store'])->name('blog.store');
        Route::get('/blog/{post}/edit', [BlogController::class, 'edit'])->name('blog.edit');
        Route::put('/blog/{post}', [BlogController::class, 'update'])->name('blog.update');
        Route::delete('/blog/{post}', [BlogController::class, 'destroy'])->name('blog.destroy');

        //Blog Category
        Route::resource('blog/categories', BlogCategoryController::class)
            ->names('blog.categories')
            ->except(['show']);

        // Admin Tag Routes
        Route::resource('blog/tags', BlogTagController::class)
            ->names('blog.tags')
            ->except(['show']);

        //User Control
        Route::middleware(['permission:users.view'])->group(function () {
            Route::resource('users', UserController::class);
        });

        //User Role Setup
        Route::middleware(['permission:userrole.index'])->group(function () {
            Route::get('/userrole', [UserRoleController::class, 'index'])->name('userrole.index');
            Route::get('/userrole/{user}/edit', [UserRoleController::class, 'edit'])->name('userrole.edit');
            Route::post('/userrole/{user}/role', [UserRoleController::class, 'assignRole'])->name('userrole.role.assign');
        });

        //User Module Assignment
        Route::middleware(['permission:usermodule.view'])->group(function () {
            Route::resource('usermodule', RoleController::class)
                ->parameters([
                    'usermodule' => 'role'
                ]);
            Route::post('/usermodule/{role}/permissions', [RoleController::class, 'syncPermissions'])->name('usermodule.permissions.sync');
        });

});

require __DIR__.'/auth.php';