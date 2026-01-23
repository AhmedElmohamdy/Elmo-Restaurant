<?php

use App\Http\Controllers\AboutAdminController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookAdminController;
use App\Http\Controllers\CategoryAdminController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\OffersAdminController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReviewsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminReviewsController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\RedirectIfAuthenticated;




//home route
Route::get('/HomePage', [HomePageController::class, 'indexs'])->name('home.index');  

//products
Route::get('/ProductDetails/{id}', [ProductController::class, 'GetProductDetails'])->name('Product.GetProductDetails');
//Get All Products and Products By Category Id
Route::get('/Product/{CatId?}', [ProductController::class, 'GetAllProductCategoryAction'])->name('Product.GetAllProduct');
//Menu route
Route::get('/Menu', [ProductController::class, 'Menu'])->name('Product.GetMenu');



//booking route
Route::get('/Booking', [HomePageController::class, 'Booking'])->name('home.booking');
//Save Booking route
Route::post('/Booking/Save', [HomePageController::class, 'SaveBooking'])->name('home.saveBooking');
//bookings route
Route::get('/Bookings', [HomePageController::class, 'Bookings'])->name('home.bookings');



//categories route
Route::get('/Categories', [CategoryController::class, 'GetAllCategories'])->name('Category.GetAllCategories');

//offers route
Route::get('/Offers', [HomePageController::class, 'Offers'])->name('home.offers');



// Admin Routes
Route::middleware(['auth', RoleMiddleware::class . ':admin,superadmin'])->group(function () {
    Route::get('/Admin', [AdminController::class, 'index'])->name('Admin.index');
});

//products Admin route
Route::get('/Admin/Product', [ProductAdminController::class, 'index'])->name('Admin.GetProduct');
//Add New Product route
Route::get('/Products/AddNew', [ProductAdminController::class, 'AddNewProduct'])->name('Admins.Product');
//Save New Product route
Route::post('/Products/Save', [ProductAdminController::class, 'Save'])->name('Admin.SaveProduct');
//Edit Product route
Route::get('/Products/Edit/{id}', [ProductAdminController::class, 'Edit'])->name('Admin.EditProduct');
//Delete Product route
Route::delete('/Products/Delete/{id}', [ProductAdminController::class, 'DeleteProduct'])->name('Admin.DeleteProduct');


//Category Admin route
Route::get('/Category', [CategoryAdminController::class, 'index'])->name('Admin.GetCategory');
//Add New Category route
Route::get('/Category/AddNew', [CategoryAdminController::class, 'AddNewCategory'])->name('Admin.AddNewCategory');
//Save New Category route
Route::post('/Category/Save', [CategoryAdminController::class, 'Save'])->name('Admin.SaveCategory');
//Edit Category route
Route::get('/Category/Edit/{id}', [CategoryAdminController::class, 'EditCategory'])->name('Admin.EditCategory');
//Delete Category route
Route::delete('/Category/Delete/{id}', [CategoryAdminController::class, 'DeleteCategory'])->name('Admin.DeleteCategory');


//offers Admin route
Route::get('/Offers', [OffersAdminController::class, 'index'])->name('Admin.GetOffers');
//Add New Offer route
Route::get('/Offers/AddNew', [OffersAdminController::class, 'AddNewOffer'])->name('Admin.AddNewOffer');
//Save New Offer route
Route::post('/Offers/Save', [OffersAdminController::class, 'Save'])->name('Admin.SaveOffer');
//Edit Offer route
Route::get('/Offers/Edit/{id}', [OffersAdminController::class, 'EditOffer'])->name('Admin.EditOffer');
//Delete Offer route
Route::delete('/Offers/Delete/{id}', [OffersAdminController::class, 'DeleteOffer'])->name('Admin.DeleteOffer');


//about Admin route
Route::get('/Admin/Abouts/GetAll', [AboutAdminController::class, 'index'])->name('Admin.GetAbouts');
//Add New About route
Route::get('/About/AddNew', [AboutAdminController::class, 'AddNewAbout'])->name('Admin.AddNewAbout');
//Save New About route
Route::post('/About/Save', [AboutAdminController::class, 'Save'])->name('Admin.SaveAbout');
//Edit About route
Route::get('/About/Edit/{id}', [AboutAdminController::class, 'EditAbout'])->name('Admin.EditAbout');
//Delete About route
Route::delete('/About/Delete/{id}', [AboutAdminController::class, 'DeleteAbout'])->name('Admin.DeleteAbout');


//bookings Admin route
Route::get('/Bookings', [BookAdminController::class, 'index'])->name('Admin.GetBook');
//Delete Booking route
Route::delete('/Bookings/Delete/{id}', [BookAdminController::class, 'DeleteBooking'])->name('Admin.DeleteBooking');



//Reviews route
// Show all reviews 
Route::get('/reviews', [ReviewsController::class, 'index'])->name('reviews.index');


// Admin Reviews route
Route::get('/Admin/Reviews', [AdminReviewsController::class, 'index'])->name('Admin.GetReviews');
Route::delete('/Admin/Reviews/Delete/{id}', [AdminReviewsController::class, 'DeleteReview'])->name('Admin.DeleteReview');

// Store a new review 
Route::post('/reviews/store', [ReviewsController::class, 'store'])->name('reviews.store');

//about route 
Route::get('/About', [HomePageController::class, 'About'])->name('home.about');


//Slider Admin route
Route::get('/Admin/Slider', [SliderController::class, 'index'])->name('Admin.GetSlider');
//Add New Slider route
Route::get('/Slider/AddNew', [SliderController::class, 'AddNewSlider'])->name('Admin.AddNewSlider');
//Save New Slider route
Route::post('/Slider/Save', [SliderController::class, 'Save'])->name('Admin.SaveSlider');
//Edit Slider route
Route::get('/Slider/Edit/{id}', [SliderController::class, 'EditSlider'])->name('Admin.EditSlider');
//Delete Slider route
Route::delete('/Slider/Delete/{id}', [SliderController::class, 'DeleteSlider'])->name('Admin.DeleteSlider');


//Settings Admin route
Route::get('/Admin/Settings', [SettingsController::class, 'index'])->name('Admin.GetSettings');
//Add New Settings route
Route::get('/Settings/AddNew', [SettingsController::class, 'AddNewSettings'])->name('Admin.AddNewSettings');
//Save New Settings route
Route::post('/Settings/Save', [SettingsController::class, 'Save'])->name('Admin.SaveSettings');
//Edit Settings route
Route::get('/Settings/Edit/{id}', [SettingsController::class, 'EditSettings'])->name('Admin.EditSettings');
//Delete Settings route
Route::delete('/Settings/Delete/{id}', [SettingsController::class, 'DeleteSettings'])->name('Admin.DeleteSettings');






Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Auth::routes();

//Login
Route::get('login', [LoginController::class, 'showLoginForm'])->middleware(AuthMiddleware::class)->name('login');
Route::post('login', [LoginController::class, 'login'])->middleware(AuthMiddleware::class);
Route::post('logout', [LoginController::class, 'logout'])->middleware(AuthMiddleware::class)->name('logout');


// Registration Routes
Route::get('register', [RegisterController::class, 'create'])->middleware(AuthMiddleware::class)->name('register');
Route::post('register', [RegisterController::class, 'store'])->middleware(AuthMiddleware::class);
Route::get('/register/success', [RegisterController::class, 'success'])->name('register.success');

// Password Reset Routes
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');


