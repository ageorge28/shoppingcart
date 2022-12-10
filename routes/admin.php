<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TaxShippingController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\BlogCategoryController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/admin', [AdminController::class, 'index'])->middleware(['admin'])->name('admin');

Route::get('/admin/login', [AdminController::class, 'create'])->name('admin.login');

Route::post('/admin/login', [AdminController::class, 'store'])->name('admin.store');

Route::get('/admin/products', [AdminController::class, 'products'])->middleware(['admin'])->name('admin.products');

Route::get('/admin/products/add', [ProductController::class, 'create'])->middleware(['admin'])->name('admin.products.create');

Route::post('/admin/products/store', [ProductController::class, 'store'])->middleware(['admin'])->name('admin.products.store');

Route::get('/admin/products/{product}/edit', [ProductController::class, 'edit'])->middleware(['admin'])->name('admin.products.edit');

Route::put('/admin/products/{product}/update', [ProductController::class, 'update'])->middleware(['admin'])->name('admin.products.update');

Route::delete('/admin/products/{product}/delete', [ProductController::class, 'destroy'])->middleware(['admin'])->name('admin.products.delete');

Route::get('/admin/categories', [AdminController::class, 'categories'])->middleware(['admin'])->name('admin.categories');

Route::get('/admin/categories/add', [CategoryController::class, 'create'])->middleware(['admin'])->name('admin.categories.create');

Route::post('/admin/categories/store', [CategoryController::class, 'store'])->middleware(['admin'])->name('admin.categories.store');

Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])->middleware(['admin'])->name('admin.categories.edit');

Route::put('/admin/categories/{category}/update', [CategoryController::class, 'update'])->middleware(['admin'])->name('admin.categories.update');

Route::delete('/admin/categories/{category}/delete', [CategoryController::class, 'destroy'])->middleware(['admin'])->name('admin.categories.delete');

Route::get('/admin/carts', [AdminController::class, 'carts'])->middleware(['admin'])->name('admin.carts');

Route::get('/admin/carts/{cart}', [CartController::class, 'show'])->middleware(['admin'])->name('admin.carts.show');

Route::get('/admin/carts/{cart}/edit', [CartController::class, 'edit'])->middleware(['admin'])->name('admin.carts.edit');

Route::get('/admin/carts/{cart}/update', [CartController::class, 'update'])->middleware(['admin'])->name('admin.carts.update');

Route::delete('/admin/carts/{cart}/delete', [CartController::class, 'destroy'])->middleware(['admin'])->name('admin.carts.delete');

Route::get('/admin/orders', [AdminController::class, 'orders'])->middleware(['admin'])->name('admin.orders');

Route::get('/admin/orders/{order}/show', [OrderController::class, 'show'])->middleware(['admin'])->name('admin.orders.show');

Route::get('/admin/orders/{order}/edit', [OrderController::class, 'edit'])->middleware(['admin'])->name('admin.orders.edit');

Route::put('/admin/orders/{order}/update', [OrderController::class, 'update'])->middleware(['admin'])->name('admin.orders.update');

Route::delete('/admin/orders/{order}/delete', [OrderController::class, 'destroy'])->middleware(['admin'])->name('admin.orders.delete');

Route::get('/admin/coupons', [AdminController::class, 'coupons'])->middleware(['admin'])->name('admin.coupons');

Route::get('/admin/coupons/add', [CouponController::class, 'create'])->middleware(['admin'])->name('admin.coupons.create');

Route::post('/admin/coupons/store', [CouponController::class, 'store'])->middleware(['admin'])->name('admin.coupons.store');

Route::get('/admin/coupons/{coupon}/edit', [CouponController::class, 'edit'])->middleware(['admin'])->name('admin.coupons.edit');

Route::put('/admin/coupons/{coupon}/update', [CouponController::class, 'update'])->middleware(['admin'])->name('admin.coupons.update');

Route::delete('/admin/coupons/{coupon}/delete', [CouponController::class, 'destroy'])->middleware(['admin'])->name('admin.coupons.delete');

Route::get('/admin/companies', [AdminController::class, 'companies'])->middleware(['admin'])->name('admin.companies');

Route::get('/admin/companies/add', [CompanyController::class, 'create'])->middleware(['admin'])->name('admin.companies.create');

Route::post('/admin/companies/store', [CompanyController::class, 'store'])->middleware(['admin'])->name('admin.companies.store');

Route::get('/admin/companies/{company}/edit', [CompanyController::class, 'edit'])->middleware(['admin'])->name('admin.companies.edit');

Route::put('/admin/companies/{company}/update', [CompanyController::class, 'update'])->middleware(['admin'])->name('admin.companies.update');

Route::delete('/admin/companies/{company}/delete', [CompanyController::class, 'destroy'])->middleware(['admin'])->name('admin.companies.delete');

Route::get('/admin/statuses', [AdminController::class, 'statuses'])->middleware(['admin'])->name('admin.statuses');

Route::get('/admin/statuses/add', [StatusController::class, 'create'])->middleware(['admin'])->name('admin.statuses.create');

Route::post('/admin/statuses/store', [StatusController::class, 'store'])->middleware(['admin'])->name('admin.statuses.store');

Route::get('/admin/statuses/{status}/edit', [StatusController::class, 'edit'])->middleware(['admin'])->name('admin.statuses.edit');

Route::put('/admin/statuses/{status}/update', [StatusController::class, 'update'])->middleware(['admin'])->name('admin.statuses.update');

Route::delete('/admin/statuses/{status}/delete', [StatusController::class, 'destroy'])->middleware(['admin'])->name('admin.statuses.delete');

Route::get('/admin/blogs', [AdminController::class, 'blogs'])->middleware(['admin'])->name('admin.blogs');

Route::get('/admin/blogs/add', [BlogController::class, 'create'])->middleware(['admin'])->name('admin.blogs.create');

Route::post('/admin/blogs/store', [BlogController::class, 'store'])->middleware(['admin'])->name('admin.blogs.store');

Route::get('/admin/blogs/{blog}/edit', [BlogController::class, 'edit'])->middleware(['admin'])->name('admin.blogs.edit');

Route::put('/admin/blogs/{blog}/update', [BlogController::class, 'update'])->middleware(['admin'])->name('admin.blogs.update');

Route::delete('/admin/blogs/{blog}/delete', [BlogController::class, 'destroy'])->middleware(['admin'])->name('admin.blogs.delete');

Route::get('/admin/blogcategory', [AdminController::class, 'blogcategories'])->middleware(['admin'])->name('admin.blogcategories');

Route::get('/admin/blogcategory/add', [BlogCategoryController::class, 'create'])->middleware(['admin'])->name('admin.blogcategories.create');

Route::post('/admin/blogcategory/store', [BlogCategoryController::class, 'store'])->middleware(['admin'])->name('admin.blogcategories.store');

Route::get('/admin/blogcategory/{blog_category}/edit', [BlogCategoryController::class, 'edit'])->middleware(['admin'])->name('admin.blogcategories.edit');

Route::put('/admin/blogcategory/{blog_category}/update', [BlogCategoryController::class, 'update'])->middleware(['admin'])->name('admin.blogcategories.update');

Route::delete('/admin/blogcategory/{blog_category}/delete', [BlogCategoryController::class, 'destroy'])->middleware(['admin'])->name('admin.blogcategories.delete');

Route::get('/admin/taxshipping', [AdminController::class, 'taxshipping'])->middleware(['admin'])->name('admin.taxshipping');

Route::get('/admin/taxshipping/edit', [TaxShippingController::class, 'edit'])->middleware(['admin'])->name('admin.taxshipping.edit');

Route::put('/admin/taxshipping/update', [TaxShippingController::class, 'update'])->middleware(['admin'])->name('admin.taxshipping.update');

Route::post('/admin/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('admin.logout');