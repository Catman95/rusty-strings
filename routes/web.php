<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\OrderController;

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

Route::get('/', [ProductController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/shop', [PageController::class, 'shop'])->name('shop');

Route::get('/login', function () {
    return view('pages.login');
})->name('login');

Route::get('/cart', function () {
    return view('pages.cart');
})->name('cart');

Route::get('/checkout', function () {
    return view('pages.checkout');
})->name('checkout')->middleware('logged_in');

Route::get('/product', function () {
    return view('pages.product');
})->name('product');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/admin', function () {
    return view('pages.admin');
})->name('admin')->middleware('logged_in');

Route::get('/account', [OrderController::class, 'get_by_user'])->name('account')->middleware('logged_in');

Route::prefix('products')->group(function () {
    Route::post('/add', [ProductController::class, 'store']);
    Route::get('/create', [ProductController::class, 'create']);
    Route::get('/show/{id}', [ProductController::class, 'show']);
    Route::post('/get', [ProductController::class, 'filter']);
    Route::post('/cart/get', [ProductController::class, 'cart']);
});


Route::prefix('order')->group(function(){
    Route::post('/checkout_list', [OrderController::class, 'checkout_list']);
    Route::post('/place', [OrderController::class, 'store']);
    Route::get('/show/{id}', [OrderController::class, 'show']);
});

Route::prefix('user')->group(function () {
    Route::post('/register', [UserController::class, 'store'])->name('do-register');
    Route::post('/login', [UserController::class, 'login'])->name('do-login');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
    Route::get('/email_verify/{email}/{code}', [UserController::class, 'email_verify'])->name('email-verify');
    Route::post('/update/{id}', [UserController::class, 'update'])->name('user-update');
});
