<?php


use App\Http\Controllers\ControlPanel\Client\Auth\LoginController;
use App\Http\Controllers\ControlPanel\Client\Auth\RegisterController;
use App\Http\Controllers\ControlPanel\Client\CartController;
use App\Http\Controllers\ControlPanel\Client\HomeController;
use App\Http\Controllers\ControlPanel\Client\OrderController;
use App\Http\Controllers\ControlPanel\Client\ProductController;
use App\Http\Controllers\ControlPanel\Seller\ShopController;
use App\Http\Controllers\ControlPanel\Client\UserController;
use Illuminate\Support\Facades\Route;



Route::get('/login', [LoginController::class, 'login'])->name('cp.client.auth.login.get');
Route::post('custom-login', [LoginController::class, 'customLogin'])->name('login.custom');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'register'])->name('cp.client.auth.register.get');
Route::post('custom-registration', [RegisterController::class, 'customRegistration'])->name('register.custom');
Route::get('/auth/verify-email/{verification_code}', [RegisterController::class, 'verifyEmail'])->name('verify.email');

    Route::get('/', [HomeController::class, 'index'])->name('main');

    Route::get('/success-verify', function (){
        return view('control_panel.client.auth.success');
    })->name('success.verify');

    Route::get('/verify', function (){
        return view('control_panel.client.auth.verify');
    })->name('email.verify');
    Route::post('/check-code', [RegisterController::class, 'checkCode'])->name('check.code');
    Route::post('/send-again', [RegisterController::class, 'sendAgain'])->name('send.again');


    Route::prefix('product')->name('product.')->group(function (){
        Route::get('/{slug}', [ProductController::class, 'show'])->name('show');
    });

//    CART
    Route::get('/add-to-cart', [CartController::class, 'addToCart'])->name('addProduct.toCart');
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::put('/update-cart', [CartController::class, 'update'])->name('update.cart');
    Route::delete('/delete-product', [CartController::class, 'remove'])->name('delete.product');
    Route::delete('/clear-product', [CartController::class, 'clear'])->name('clear.cart');

    //      ORDER
    Route::get('orders/create', [OrderController::class , 'create'])->name('order.create');
    Route::post('orders/store', [OrderController::class , 'store'])->name('order.store');
    Route::get('get/documents/{id}', [OrderController::class , 'getDocuments'])->name('order.documents');


    Route::prefix('shop')->name('shop.')->group(function (){
        Route::get('/{slug}', [ShopController::class, 'show'])->name('show');
        Route::get('/ajax/get-products', [ShopController::class, 'getProductsByCategory'])->name('get.category.products');
        Route::get('/{slug}/product/product_{productSlug}', [ProductController::class, 'shopProductShow'])->name('product.show');
    });


Route::group([
    'middleware' => 'auth',
], function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/change-password', [UserController::class, 'changePassword'])->name('change.password');
    Route::get('/test', function (){
        return view('error');
    });
});
    Route::get('orders/index', [OrderController::class , 'index'])->name('order.index');
    Route::get('get/products/{id}', [OrderController::class , 'getCreditProduct'])->name('order.products');

