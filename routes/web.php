<?php

//Admin
use App\Http\Controllers\admin\AmenitiyController;
use App\Http\Controllers\admin\ArtController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\HeroController;
use App\Http\Controllers\admin\ImageGalleryController;
use App\Http\Controllers\admin\LocationController;
use App\Http\Controllers\admin\LoginController as AdminLoginController;
use App\Http\Controllers\admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\PendingArtController;
use App\Http\Controllers\admin\ProfileController as AdminProfileController;

//User
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\frontend\ProfileController;
use App\Http\Controllers\frontend\UserArtController;
use App\Http\Controllers\frontend\UserImageGalleryController;
use App\Http\Controllers\frontend\UserVideoGalleryController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\PasswordResetLinkController;
use App\Http\Controllers\admin\VideoGalleryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;


Route::get('/', [FrontendController::class, 'index'])->name('home');

Route::group(['prefix' => 'account','as' => 'account.'], function () {
    //Guest middleware
    Route::group(['middleware' => 'guest'], function () {

        Route::get('login', [LoginController::class, 'index'])->name('login');
        Route::get('register', [LoginController::class, 'register'])->name('register');
        Route::post('process-register', [LoginController::class, 'processRegister'])->name('processRegister');
        Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
        Route::get('password-request', [LoginController::class, 'passwordRequest'])->name('password.request');
        Route::post('resetpassword', [PasswordResetLinkController::class, 'sendResetLinkEmail'])->name('password.email');
        // Route::get('resetpassword/{token}', [NewPasswordController::class, 'create'])
        //     ->name('password.reset');

        // Route::post('resetpassword', [NewPasswordController::class, 'store'])
        //     ->name('password.store');


    });
    // Authenticated middleware
    Route::group(['middleware' => 'auth'], function () {

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('profile', [ProfileController::class, 'index'])->name('profile');
        Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::put('password-update', [ProfileController::class, 'passwordUpdate'])->name('profile.passwordUpdate');
        Route::get('logout', [LoginController::class, 'logout'])->name('logout');

        //Art Routes
        Route::resource('arts' ,UserArtController::class);

        Route::resource('image-gallery',UserImageGalleryController::class);

        Route::resource('video-gallery',UserVideoGalleryController::class);


    });


});


Route::group(['prefix' => 'admin'], function () {

    Route::group(['middleware' => 'admin.guest'], function () {
        //Login Routes
        Route::get('login', [AdminLoginController::class, 'index'])->name('admin.login');
        Route::post('authenticate', [AdminLoginController::class, 'authenticate'])->name('admin.authenticate');
        Route::get('password-request', [AdminLoginController::class, 'passwordRequest'])->name('admin.password.request');
        Route::view('error-403', 'errors-403')->name('admin.error-403');
    });

    Route::group(['middleware' => 'admin.auth'], function () {

        //Dashboard Routes
        Route::get('dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');

        // Profile Routes
        Route::get('profile', [AdminProfileController::class, 'index'])->name('admin.profile');
        Route::put('profile', [AdminProfileController::class, 'update'])->name('admin.profile.update');
        Route::put('password-update', [AdminProfileController::class, 'passwordUpdate'])->name('admin.profile.passwordUpdate');

        //Hero Routes
        Route::get('/hero',[HeroController::class,'index'])->name('admin.hero.index');
        Route::put('/hero',[HeroController::class,'update'])->name('admin.hero.update');

        //category Routes
        Route::resource('category',CategoryController::class)->except(['show']);

        //location Routes
        Route::resource('location',LocationController::class)->except(['show']);

        // Amenity Routes
        Route::resource('amenity',AmenitiyController::class)->except(['show']);

        // Arts Routes
        Route::resource('arts',ArtController::class)->except(['show']);

         // Arts Routes
        Route::get('pending-arts',[PendingArtController::class,'index'])->name('admin.pending-arts.index');
        Route::post('pending-arts',[PendingArtController::class,'update'])->name('admin.pending-arts.update');

        // Image Gallery Routes
        Route::resource('image-gallery',ImageGalleryController::class)->except(['show']);

        // Image Gallery Routes
        Route::resource('video-gallery',VideoGalleryController::class)->except(['show']);
    });

});








