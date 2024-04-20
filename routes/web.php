<?php

use App\Http\Livewire\AboutUs;
use App\Http\Livewire\AboutUsComponent;
use App\Http\Livewire\AboutUsPageComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\CheckoutsComponent;
use App\Http\Livewire\ContactComponent;
use App\Http\Livewire\ContactUsComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\DisplayOrderDetails;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\OrdersComponent;
use App\Http\Livewire\SaleProducts;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\WishlistComponent;
use App\Models\admin\Category;
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

Route::get('/', HomeComponent::class)->name('home');


Route::get('user_dashboard', function () {
    return view('Front.user_dashboard');
});

Route::get('/shop', ShopComponent::class)->name('shop');
Route::get('/cart', CartComponent::class)->name('shop.cart');
Route::get('/wishlist', WishlistComponent::class)->name('shop.wishlist');
Route::get('/contact', ContactUsComponent::class)->name('contact');
Route::get('/checkouts', CheckoutsComponent::class)->name('checkouts');
Route::get('/about-us', AboutUsComponent::class)->name('about-us');
Route::get('/product/{slug}', DetailsComponent::class)->name('product.details');
Route::get('/sale-product/{id}', SaleProducts::class)->name('sale.product');
Route::get('/category/{id}', CategoryComponent::class)->name('category');
// Route::get('/search', SearchComponent::class)->name('product.search');

Route::middleware(['auth'])->group(function () {
    Route::get('/my-orders', OrdersComponent::class)->name('my-orders');
    Route::get('/order/{id}', DisplayOrderDetails::class)->name('order.details');

});

Auth::routes();
