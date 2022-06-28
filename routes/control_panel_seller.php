<?php

use App\Http\Controllers\ControlPanel\Admin\HomeController;
use App\Http\Controllers\ControlPanel\Seller\ProductController;
use Illuminate\Support\Facades\Route;

Route::group([
    //'middleware' => 'shop_admin',
    'prefix' => 'cp/seller'
], function () {
    Route::group(['prefix' => 'assortments'], function () {
        Route::get('/', [ProductController::class, 'getList'])->name('listProducts');
        Route::get('/search-query', [ProductController::class, 'autocomplete'])->name('search.product');
        Route::get('/product/{id}', [ProductController::class, 'createPropertiesProduct'])->name('product.create.properties');
        Route::post('/product/store', [ProductController::class, 'storeProperties'])->name('product.store.properties');
        Route::get('/product/edit/{id}', [ProductController::class, 'editPropertiesProduct'])->name('product.edit.properties');
        Route::put('/product/update/{id}', [ProductController::class, 'updatePropertiesProduct'])->name('product.update.properties');

    });
});


