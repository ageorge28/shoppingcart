<?php

use Illuminate\Support\Facades\Route;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\RazorpayPaymentController;
use App\Http\Controllers\MailController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::get('/', function() {
//     return view('welcome');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['user'])->name('dashboard');

require __DIR__.'/auth.php';

require __DIR__.'/admin.php';

Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/filter', [HomeController::class, 'filter'])->name('filter');

Route::get('/products', [ProductController::class, 'index'])->name('products');

Route::get('/products/category/{slug}', [ProductController::class, 'category'])->name('products.category');

Route::get('/products/{slug}', [ProductController::class, 'show'])->name('product');

Route::get('/blog', [BlogController::class, 'index'])->name('blogs');

Route::get('/blog/{slug}', [BlogController::class, 'show'])->name('blog');

Route::get('/blog/searchbytag/{tag}', [BlogController::class, 'searchbytag'])->name('blog.search_by_tag');

Route::get('/blog/searchbycategory/{category}', [BlogController::class, 'searchbycategory'])->name('blog.search_by_category');

Route::get(RouteServiceProvider::HOME, [HomeController::class, 'dashboard'])->middleware(['user'])->name('dashboard');

Route::get('/cart', [CartController::class, 'index'])->name('cart');;

Route::get('/ajax/add/{product_id}', [CartController::class, 'ajaxAdd'])->name('ajax.add');

Route::post('/ajax/update', [CartController::class, 'ajaxUpdate'])->name('ajax.update');

Route::get('/ajax/delete/{cart_product_id}', [CartController::class, 'ajaxDelete'])->name('ajax.delete');

Route::post('/ajax/coupon', [CartController::class, 'ajaxCoupon'])->name('ajax.coupon');

Route::get('/dashboard/account', function () {
    return view('dashboard');
})->middleware(['user'])->name('dashboard.account');

Route::post('/dashboard/account', [UserController::class, 'update'])->middleware(['user'])->name('account');

Route::get('/dashboard/orders', [HomeController::class, 'orders'])->middleware(['user'])->name('orders');

Route::get('/dashboard/addresses', [HomeController::class, 'address'])->middleware(['user'])->name('address');

Route::get('/dashboard/addresses/create', [AddressController::class, 'create'])->middleware(['user'])->name('address.create');

Route::post('/dashboard/addresses/store', [AddressController::class, 'store'])->middleware(['user'])->name('address.store');

Route::get('/dashboard/addresses/{address}/edit', [AddressController::class, 'edit'])->middleware(['user'])->name('address.edit');

Route::put('/dashboard/addresses/{address}/update', [AddressController::class, 'update'])->middleware(['user'])->name('address.update');

Route::delete('/dashboard/addresses/{address}/delete', [AddressController::class, 'destroy'])->middleware(['user'])->name('address.delete');

Route::get('/checkout', [OrderController::class, 'create'])->name('checkout');

Route::get('/checkout/{order_id}', [OrderController::class, 'create'])->name('checkout.order');

Route::post('/order', [OrderController::class, 'store'])->name('order.store');

Route::get('/order/{order_id}', [PaymentController::class, 'index'])->name('order');

Route::post('/payment', [PaymentController::class, 'payment'])->name('payment');

Route::get('/email', [MailController::class, 'email'])->middleware(['user'])->name('email');

Route::post('/contact', [HomeController::class, 'contact_submit'])->name('contact.submit');

// Route::get('/checkout', [RazorpayPaymentController::class, 'checkout']);
// Route::post('/checkout-callback', [RazorpayPaymentController::class, 'checkoutCallback']);