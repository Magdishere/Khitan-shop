<?php

use App\Http\Controllers\admin\AdminAttributeController;
use App\Http\Controllers\admin\AdminCategoriesController;
use App\Http\Controllers\admin\AdminContactController;
use App\Http\Controllers\admin\AdminCouponsController;
use App\Http\Controllers\admin\AdminOrdersController;
use App\Http\Controllers\admin\AdminProductsController;
use App\Http\Controllers\admin\AdminReviewsController;
use App\Http\Controllers\admin\AdminSalesController;
use App\Http\Controllers\admin\AdminSlidesController;
use App\Http\Controllers\admin\AdminStringsController;
use App\Http\Controllers\admin\OrdersArchiveController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\admin\OrdersController;
use App\Models\admin\ProductAttributeOption;
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

Route::group(['middleware' => 'guest.admin'], function () {

    Route::get('/admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/admin/login', [AdminAuthController::class, 'login'])->name('admin.login');


    Route::get('/admin/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
    Route::post('/admin/register', [AdminAuthController::class, 'register'])->name('admin.register');
});
Route::post('/admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->middleware(['admin'])->group(function () {
    // Admin dashboard route
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    //Admin Category
    Route::resource('Admin-Categories', AdminCategoriesController::class);
    Route::resource('admin-products', AdminProductsController::class);
    Route::resource('admin-sales', AdminSalesController::class);
    Route::resource('admin-attributes', AdminAttributeController::class);
    Route::resource('admin-options', ProductAttributeOption::class);
    Route::resource('admin-slides', AdminSlidesController::class);
    Route::resource('admin-orders', AdminOrdersController::class);
    Route::resource('admin-strings', AdminStringsController::class);
    Route::resource('admin-coupons', AdminCouponsController::class);
    Route::resource('admin-messages', AdminContactController::class);
    Route::resource('admin-reviews', AdminReviewsController::class);
    Route::resource('admin-archived_orders', OrdersArchiveController::class);

    //Orders by Status
    Route::get('/orders/status/{status}', [AdminOrdersController::class, 'getOrdersByStatus'])->name('orders.status');

});
