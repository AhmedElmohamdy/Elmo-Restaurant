<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ReviewsController;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\CategoryAdminController;
use App\Http\Controllers\OffersAdminController;
use App\Http\Controllers\BookAdminController;
use App\Http\Controllers\AdminReviewsController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\AboutAdminController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AdminNotificationController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\AuthMiddleware;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomePageController::class, 'indexs'])->name('home.index');
Route::get('/Menu', [ProductController::class, 'Menu'])->name('Product.GetMenu');
Route::get('/Product/{CatId?}', [ProductController::class, 'GetAllProductCategoryAction'])->name('Product.GetAllProduct');
Route::get('/ProductDetails/{id}', [ProductController::class, 'GetProductDetails'])->name('Product.GetProductDetails');
Route::get('/Categories', [CategoryController::class, 'GetAllCategories'])->name('Category.GetAllCategories');
Route::get('/Offers', [HomePageController::class, 'Offers'])->name('home.offers');
Route::get('/About', [HomePageController::class, 'About'])->name('home.about');
Route::get('/reviews', [ReviewsController::class, 'index'])->name('reviews.index');
Route::get('/Bookings', [HomePageController::class, 'Booking'])->name('home.booking');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    // Save Booking
    Route::post('/Booking/Save', [HomePageController::class, 'SaveBooking'])->name('home.saveBooking');

    // Store User Review
    Route::post('/reviews/store', [ReviewsController::class, 'store'])->name('reviews.store');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', RoleMiddleware::class . ':admin,superadmin'])
    ->prefix('Admin')
    ->group(function () {

        Route::get('/', [AdminController::class, 'index'])->name('Admin.index');

        // Products
        Route::get('/Product', [ProductAdminController::class, 'index'])->name('Admin.GetProduct');
        Route::get('/Product/AddNew', [ProductAdminController::class, 'AddNewProduct'])->name('Admin.AddProduct');
        Route::post('/Product/Save', [ProductAdminController::class, 'Save'])->name('Admin.SaveProduct');
        Route::get('/Product/Edit/{id}', [ProductAdminController::class, 'Edit'])->name('Admin.EditProduct');
        Route::delete('/Product/Delete/{id}', [ProductAdminController::class, 'DeleteProduct'])->name('Admin.DeleteProduct');

        // Categories
        Route::get('/Category', [CategoryAdminController::class, 'index'])->name('Admin.GetCategory');
        Route::get('/Category/AddNew', [CategoryAdminController::class, 'AddNewCategory'])->name('Admin.AddNewCategory');
        Route::post('/Category/Save', [CategoryAdminController::class, 'Save'])->name('Admin.SaveCategory');
        Route::get('/Category/Edit/{id}', [CategoryAdminController::class, 'EditCategory'])->name('Admin.EditCategory');
        Route::delete('/Category/Delete/{id}', [CategoryAdminController::class, 'DeleteCategory'])->name('Admin.DeleteCategory');

        // Offers
        Route::get('/Offers', [OffersAdminController::class, 'index'])->name('Admin.GetOffers');
        Route::get('/Offers/AddNew', [OffersAdminController::class, 'AddNewOffer'])->name('Admin.AddNewOffer');
        Route::post('/Offers/Save', [OffersAdminController::class, 'Save'])->name('Admin.SaveOffer');
        Route::get('/Offers/Edit/{id}', [OffersAdminController::class, 'EditOffer'])->name('Admin.EditOffer');
        Route::delete('/Offers/Delete/{id}', [OffersAdminController::class, 'DeleteOffer'])->name('Admin.DeleteOffer');

        // Bookings
        Route::get('/Bookings', [BookAdminController::class, 'index'])->name('Admin.GetBook');
        Route::post('/Bookings/Accept/{id}', [BookAdminController::class, 'AcceptBooking'])->name('Admin.AcceptBooking');
        Route::delete('/Bookings/Delete/{id}', [BookAdminController::class, 'DeleteBooking'])->name('Admin.DeleteBooking');

        // Reviews
        Route::get('/Reviews', [AdminReviewsController::class, 'index'])->name('Admin.GetReviews');
        Route::delete('/Reviews/Delete/{id}', [AdminReviewsController::class, 'DeleteReview'])->name('Admin.DeleteReview');

        // Slider
        Route::get('/Slider', [SliderController::class, 'index'])->name('Admin.GetSlider');
        Route::get('/Slider/AddNew', [SliderController::class, 'AddNewSlider'])->name('Admin.AddNewSlider');
        Route::post('/Slider/Save', [SliderController::class, 'Save'])->name('Admin.SaveSlider');
        Route::get('/Slider/Edit/{id}', [SliderController::class, 'EditSlider'])->name('Admin.EditSlider');
        Route::delete('/Slider/Delete/{id}', [SliderController::class, 'DeleteSlider'])->name('Admin.DeleteSlider');

        // About
        Route::get('/Abouts', [AboutAdminController::class, 'index'])->name('Admin.GetAbouts');
        Route::get('/About/AddNew', [AboutAdminController::class, 'AddNewAbout'])->name('Admin.AddNewAbout');
        Route::post('/About/Save', [AboutAdminController::class, 'Save'])->name('Admin.SaveAbout');
        Route::get('/About/Edit/{id}', [AboutAdminController::class, 'EditAbout'])->name('Admin.EditAbout');
        Route::delete('/About/Delete/{id}', [AboutAdminController::class, 'DeleteAbout'])->name('Admin.DeleteAbout');

        // Settings
        Route::get('/Settings', [SettingsController::class, 'index'])->name('Admin.GetSettings');
        Route::get('/Settings/AddNew', [SettingsController::class, 'AddNewSettings'])->name('Admin.AddNewSettings');
        Route::post('/Settings/Save', [SettingsController::class, 'Save'])->name('Admin.SaveSettings');
        Route::get('/Settings/Edit/{id}', [SettingsController::class, 'EditSettings'])->name('Admin.EditSettings');
        Route::delete('/Settings/Delete/{id}', [SettingsController::class, 'DeleteSettings'])->name('Admin.DeleteSettings');

        // Notifications
        Route::prefix('Notifications')->group(function () {
            Route::get('/',                        [AdminNotificationController::class, 'getNotifications'])->name('Admin.Notifications');
            Route::post('/MarkAsRead',             [AdminNotificationController::class, 'markAsRead'])->name('Admin.Notifications.MarkAsRead');
            Route::post('/MarkAsRead/{id}',        [AdminNotificationController::class, 'markOneAsRead'])->name('Admin.Notifications.MarkOneAsRead');
        });
    });

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

// Login
Route::get('login', [LoginController::class, 'showLoginForm'])->middleware(AuthMiddleware::class)->name('login');
Route::post('login', [LoginController::class, 'login'])->middleware(AuthMiddleware::class);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('register', [RegisterController::class, 'create'])->middleware(AuthMiddleware::class)->name('register');
Route::post('register', [RegisterController::class, 'store'])->middleware(AuthMiddleware::class);
Route::get('/register/success', [RegisterController::class, 'success'])->name('register.success');

