<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\Product\ProductController;
use App\Http\Controllers\Admin\Product\ProductDetailController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\ProductController as ClientProductController;
use App\Http\Controllers\Client\UserController as ClientUserController;
use App\Http\Controllers\MainController;
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

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    #Đổi mk
    Route::get('/change-password', [AuthController::class, 'changePassword'])->name('change_password');
    Route::put('/change-password', [AuthController::class, 'updatePassword'])->name('update_password');

    #Giỏ hàng
    Route::prefix('/cart')->group(function () {
        Route::post('/add-item', [CartController::class, 'addItem'])->name('add_item');
        Route::get('/', [CartController::class, 'show'])->name('show_cart');
        Route::post('/', [CartController::class, 'checkout'])->name('checkout');
        Route::put('/update-cart', [CartController::class, 'updateItem'])->name('update_item');
        Route::delete('/delete-item', [CartController::class, 'deleteItem'])->name('delete_item');
    });

    #Thông tin cá nhân
    Route::get('/tai-khoan', [ClientUserController::class, 'index'])->name('account');
    Route::get('/don-hang', [ClientUserController::class, 'getOrders'])->name('order');
    Route::put('/tai-khoan/update', [ClientUserController::class, 'updateUser'])->name('update_user');
});

Route::middleware(['guest'])->group(function () {
    #Đăng nhập
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate']);

    #Đăng ký
    Route::get('/registration', [AuthController::class, 'showRegisterForm'])->name('register');
    Route::post('/registration', [AuthController::class, 'register'])->name('register.post');
});

#Trang quản lý
Route::prefix('admin')->middleware(['auth', 'isAdmin'])->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::resource('/categories', CategoryController::class);
    Route::resource('/products', ProductController::class);
    Route::resource('/product-details', ProductDetailController::class);
    Route::resource('/orders', OrderController::class);

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
});

Route::prefix('/')->group(function () {
    #Trang chủ
    Route::get('/', [MainController::class, 'index'])->name('homepage');

    #Hiện thị thêm sản phẩm
    Route::post('/services/load-product', [ClientProductController::class, 'loadProduct']);

    #Hiển thị sản phẩm theo danh mục
    Route::get('/danh-muc/{category:slug}', [ClientProductController::class, 'index'])->name('category_filter');
    Route::get('/search-product', [ClientProductController::class, 'search_products'])->name('search_products');
    Route::get('/filter-by', [ClientProductController::class, 'filter_by'])->name('filter_by');

    #Thông tin sản phẩm
    Route::get('/san-pham/{product:slug}', [ClientProductController::class, 'show'])->name('product.show');
});
