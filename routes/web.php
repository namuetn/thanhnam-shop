<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
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

Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function () {
    Route::get('/login', [AdminController::class, 'loginForm']);
    Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

// Route::middleware(['auth:admin'])->group(function () {
    Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
        return view('admin.index');
    })->name('dashboard');

    //Admin All Route
    Route::get('/admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('/admin/profile', [AdminProfileController::class, 'adminProfile'])->name('admin.profile');
    Route::get('/admin/profile/edit', [AdminProfileController::class, 'adminProfileEdit'])->name('admin.profile.edit');
    Route::post('/admin/profile/store', [AdminProfileController::class, 'adminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminProfileController::class, 'adminChangePassword'])->name('admin.change.password');
    Route::post('/admin/update/password', [AdminProfileController::class, 'adminUpdatePassword'])->name('admin.update.password');
// });


// Admin Brand All route
Route::prefix('brands')->group(function () {
    Route::get('/', [BrandController::class, 'index'])->name('all.brand');
    Route::post('/store', [BrandController::class, 'store'])->name('brand.store');
    Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('brand.edit');
    Route::put('/update/{id}', [BrandController::class, 'update'])->name('brand.update');
    Route::get('/delete/{id}', [BrandController::class, 'destroy'])->name('brand.delete');
});

// Admin Category All route
Route::prefix('categories')->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('all.category');
    Route::post('/store', [CategoryController::class, 'store'])->name('category.store');
    Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::put('/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');

    // SubCategory All Route 
    Route::prefix('sub')->group(function () {
        Route::get('/', [SubCategoryController::class, 'index'])->name('all.subcategory');
        Route::post('/store', [SubCategoryController::class, 'store'])->name('subcategory.store');
        Route::get('/edit/{id}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
        Route::put('/update/{id}', [SubCategoryController::class, 'update'])->name('subcategory.update');
        Route::get('/delete/{id}', [SubCategoryController::class, 'destroy'])->name('subcategory.delete');
        Route::get('/ajax/{categoryId}', [SubCategoryController::class, 'getSubCategoryJson'])->name('subsubcategory.delete');

        Route::get('/sub', [SubCategoryController::class, 'subIndex'])->name('all.subsubcategory');
        Route::post('/sub/store', [SubCategoryController::class, 'subStore'])->name('subsubcategory.store');
        Route::get('/sub/edit/{id}', [SubCategoryController::class, 'subEdit'])->name('subsubcategory.edit');
        Route::put('/sub/update/{id}', [SubCategoryController::class, 'subUpdate'])->name('subsubcategory.update');
        Route::get('/sub/delete/{id}', [SubCategoryController::class, 'subDestroy'])->name('subsubcategory.delete');
        Route::get('/sub/ajax/{subcategoryId}', [SubCategoryController::class, 'getSubSubCategoryJson'])->name('subsubcategory.delete');

    });
});

// Admin Product All route
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::get('/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/store', [ProductController::class, 'store'])->name('product.store');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/update/{id}', [ProductController::class, 'update'])->name('product.update');
    Route::post('/update/multi-image', [ProductController::class, 'updateMultiImage'])->name('product.update.multi-image');
    Route::post('/update/thumnail-image/{id}', [ProductController::class, 'updateThumnailImage'])->name('product.update.thumnail-image');
    Route::get('/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
    Route::get('/delete/multi-image/{id}', [ProductController::class, 'destroyMultiImage'])->name('product.delete.multi-image');
    Route::get('/active/{id}', [ProductController::class, 'active'])->name('product.active');
    Route::get('/inactive/{id}', [ProductController::class, 'inactive'])->name('product.inactive');
});

// Admin Slider All route
Route::prefix('sliders')->group(function () {
    Route::get('/', [SliderController::class, 'index'])->name('slider.index');
    Route::post('/store', [SliderController::class, 'store'])->name('slider.store');
    Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('slider.edit');
    Route::put('/update/{id}', [SliderController::class, 'update'])->name('slider.update');
    Route::get('/delete/{id}', [SliderController::class, 'destroy'])->name('slider.delete');
    Route::get('/active/{id}', [SliderController::class, 'active'])->name('slider.active');
    Route::get('/inactive/{id}', [SliderController::class, 'inactive'])->name('slider.inactive');
});

//--------------------Front-end----------------------
Route::group(['middleware' => 'locale'], function() {
    Route::get('change-language/{language}', [LanguageController::class, 'changeLanguage'])->name('user.change-language');

    // User All Route
    Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/', [IndexController::class, 'index']);
    Route::get('/user/logout', [IndexController::class, 'userLogout'])->name('user.logout');
    Route::get('/user/profile', [IndexController::class, 'userProfile'])->name('user.profile');
    Route::put('/user/profile/update', [IndexController::class, 'userProfileUpdate'])->name('user.profile.update');
    Route::get('/user/change/password', [IndexController::class, 'userChangePassword'])->name('user.change.password');
    Route::put('/user/update/password', [IndexController::class, 'userUpdatePassword'])->name('user.update.password');
});
