<?php

use App\Http\Controllers\StripeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\PromoCodeController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CustomerController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', function () {return redirect('main');})->middleware('guest');
Route::get('/admin', function () {return redirect('sign-in');})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest')->name('register');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify'); 
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset'); 


Route::get('main', [ProductController::class, 'main'])->name('main');

Route::get('about', function () {
	return view('customer.about');
})->name('about');




// Product Listing
Route::get('shop', [ProductController::class, 'index'])->name('cust.products.index');
Route::get('/products/details/{product}', [ProductController::class, 'display'])->name('cust.products.display');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	Route::post('/addToCart/{productId}', [CartController::class, 'addToCart'])->name('addToCart');
	Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
	Route::get('/checkout-redirect', [CartController::class, 'checkoutRedirect'])->name('checkout.redirect');
	Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
	Route::patch('/update-cart', [CartController::class, 'update'])->name('cart.update');
	Route::get('/confirm-cart', [CartController::class, 'confirm'])->name('cart.confirm');
	Route::post('/apply-promo', [CartController::class, 'applyPromo'])->name('cart.promo');
	Route::delete('/remove-cart/{productId}', [CartController::class, 'destroy'])->name('cart.remove');
	Route::resource('products', ProductController::class);
	Route::resource('categories', CategoryController::class);
	Route::get('account/edit', [CustomerController::class, 'edit'])->name('cust.edit');
	Route::patch('/{id}', [CustomerController::class, 'update'])->name('cust.update');

	Route::patch('account/update-profile/{id}', [CustomerController::class, 'update'])->name('cust.update-profile');

	Route::get('account/order-history', [CustomerController::class, 'orderHistory'])->name('cust.orders');

	// Route::get('/checkout', [StripeController::class, 'checkout']);
	Route::post('/session', [StripeController::class, 'session'])->name('session');
	Route::get('/success', [StripeController::class, 'success'])->name('success');
	});



	/**
	 * Admin Routes
	 */
	Route::prefix('/admin')->middleware(['auth', 'role:admin'])->group(function () {
		Route::get('/', [HomeController::class, 'index'])->name('admin.home');
		
		Route::prefix('/products')->group(function () {
			Route::get('/', [AdminProductController::class, 'index'])->name('admin.products.index');
			Route::get('/create', [AdminProductController::class, 'create'])->name('admin.products.create');
			Route::post('/', [AdminProductController::class, 'store'])->name('admin.products.store');
			Route::get('/show/{product}', [AdminProductController::class, 'show'])->name('admin.products.show');
			Route::get('/edit/{product}', [AdminProductController::class, 'edit'])->name('admin.products.edit');
			Route::patch('/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');
			Route::delete('/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');
		});

		Route::prefix('/users')->group(function () {
			Route::get('/', [UserController::class, 'index'])->name('users.index');
			Route::get('/create', [UserController::class, 'create'])->name('users.create');
			Route::post('/', [UserController::class, 'store'])->name('users.store');
			Route::get('/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
			Route::patch('/{id}', [UserController::class, 'update'])->name('users.update');
			Route::delete('/{id}', [UserController::class, 'destroy'])->name('users.destroy');
		});

		Route::prefix('/carts')->group(function () {
			Route::get('/', [OrderController::class, 'index'])->name('carts.index');
			Route::get('/create', [OrderController::class, 'create'])->name('carts.create');
			Route::post('/', [OrderController::class, 'store'])->name('carts.store');
			Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('carts.edit');
			Route::patch('/{id}', [OrderController::class, 'update'])->name('carts.update');
			Route::delete('/{id}', [OrderController::class, 'destroy'])->name('carts.destroy');
		});

		Route::prefix('/roles')->group(function () {
			Route::get('/', [RoleController::class, 'index'])->name('roles.index');
			Route::get('/create', [RoleController::class, 'create'])->name('roles.create');
			Route::post('/', [RoleController::class, 'store'])->name('roles.store');
			Route::get('/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
			Route::patch('/{id}', [RoleController::class, 'update'])->name('roles.update');
			Route::delete('/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
		});

		Route::prefix('/settings')->group(function () {
			Route::prefix('/categories')->group(function () {
				Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
				Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
				Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
				Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
				Route::patch('/{id}', [CategoryController::class, 'update'])->name('categories.update');
				Route::delete('/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
			});

			Route::prefix('/brands')->group(function () {
				Route::get('/', [BrandController::class, 'index'])->name('brands.index');
				Route::get('/create', [BrandController::class, 'create'])->name('brands.create');
				Route::post('/', [BrandController::class, 'store'])->name('brands.store');
				Route::get('/edit/{id}', [BrandController::class, 'edit'])->name('brands.edit');
				Route::patch('/{id}', [BrandController::class, 'update'])->name('brands.update');
				Route::delete('/{id}', [BrandController::class, 'destroy'])->name('brands.destroy');
			});

			Route::prefix('/sizes')->group(function () {
				Route::get('/', [SizeController::class, 'index'])->name('sizes.index');
				Route::get('/create', [SizeController::class, 'create'])->name('sizes.create');
				Route::post('/', [SizeController::class, 'store'])->name('sizes.store');
				Route::get('/edit/{id}', [SizeController::class, 'edit'])->name('sizes.edit');
				Route::patch('/{id}', [SizeController::class, 'update'])->name('sizes.update');
				Route::delete('/{id}', [SizeController::class, 'destroy'])->name('sizes.destroy');
			});

			Route::prefix('/colors')->group(function () {
				Route::get('/', [ColorController::class, 'index'])->name('colors.index');
				Route::get('/create', [ColorController::class, 'create'])->name('colors.create');
				Route::post('/', [ColorController::class, 'store'])->name('colors.store');
				Route::get('/edit/{id}', [ColorController::class, 'edit'])->name('colors.edit');
				Route::patch('/{id}', [ColorController::class, 'update'])->name('colors.update');
				Route::delete('/{id}', [ColorController::class, 'destroy'])->name('colors.destroy');
			});

			Route::prefix('/promo-codes')->group(function () {
				Route::get('/', [PromoCodeController::class, 'index'])->name('promo-codes.index');
				Route::get('/create', [PromoCodeController::class, 'create'])->name('promo-codes.create');
				Route::post('/', [PromoCodeController::class, 'store'])->name('promo-codes.store');
				Route::get('/edit/{id}', [PromoCodeController::class, 'edit'])->name('promo-codes.edit');
				Route::patch('/{id}', [PromoCodeController::class, 'update'])->name('promo-codes.update');
				Route::delete('/{id}', [PromoCodeController::class, 'destroy'])->name('promo-codes.destroy');
			});
		});
	});


