<?php

use App\Http\Controllers\ControlPanel\FinCompany\CreditProductController;
use App\Http\Controllers\ControlPanel\FinCompany\DocumentController;
use App\Http\Controllers\ControlPanel\FinCompany\OrderController;
use Illuminate\Support\Facades\Route;

Route::group([
    'middleware' => 'company_admin',
    'prefix' => 'cp/fin-company'
], function () {

    Route::group(['prefix' => 'credit-products'], function () {
        Route::get('/', [CreditProductController::class, 'index'])->name('cp.fin.credit_products.index');
        Route::get('create', [CreditProductController::class, 'create'])->name('cp.fin.credit_products.create');
        Route::post('store', [CreditProductController::class, 'store'])->name('cp.fin.credit_products.store');
        Route::get('edit/{id}', [CreditProductController::class, 'edit'])->name('cp.fin.credit_products.edit');
        Route::post('update/{id}', [CreditProductController::class, 'update'])->name('cp.fin.credit_products.update');
    });
    Route::group(['prefix' => 'documents'],function () {
        Route::get('/', [DocumentController::class, 'index'])->name('cp.fin.documents.index');
        Route::get('create', [DocumentController::class, 'create'])->name('cp.fin.documents.create');
        Route::post('store', [DocumentController::class, 'store'])->name('cp.fin.documents.store');
        Route::get('edit/{id}', [DocumentController::class, 'edit'])->name('cp.fin.documents.edit');
        Route::post('update/{id}', [DocumentController::class, 'update'])->name('cp.fin.documents.update');
    });
    Route::resource('orders', 'OrderController');
    Route::put('orders/archive/{id}', [OrderController::class , 'archive'])->name('orders.archive');
});
