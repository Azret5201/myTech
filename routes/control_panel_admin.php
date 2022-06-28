
<?php

use App\Http\Controllers\ControlPanel\Admin\BrandController;
use App\Http\Controllers\ControlPanel\Admin\CategoryController;
use App\Http\Controllers\ControlPanel\Admin\CompanyOperatorController;
use App\Http\Controllers\ControlPanel\Admin\EditorImageController;
use App\Http\Controllers\ControlPanel\Admin\FinanceCompanyController;
use App\Http\Controllers\ControlPanel\Admin\HomeController;
use App\Http\Controllers\ControlPanel\Admin\BlockController;
use App\Http\Controllers\ControlPanel\Admin\ProductController;
use App\Http\Controllers\ControlPanel\Admin\PropertyController;
use App\Http\Controllers\ControlPanel\Admin\ShopController;
use App\Http\Controllers\ControlPanel\Admin\ShopOperatorController;
use App\Http\Controllers\ControlPanel\Admin\StaticPageController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\AuthMiddleware;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'cp/admin', 'middleware' => 'auth'
], function (){
    Route::get('dashboard', [HomeController::class, 'index'])->name('cp.admin.home');

    Route::group(['prefix' => 'brands'], function () {
        Route::get('/', [BrandController::class, 'index'])->name('cp.admin.brand');
        Route::get('create', [BrandController::class, 'create'])->name('cp.admin.brand.create');
        Route::post('store', [BrandController::class, 'store'])->name('cp.admin.brand.store');
        Route::post('mass_store', [BrandController::class, 'massStore'])->name('cp.admin.brand.mass_store');
        Route::get('edit/{id}', [BrandController::class, 'edit'])->name('cp.admin.brand.edit');
        Route::post('update/{id}', [BrandController::class, 'update'])->name('cp.admin.brand.update');
    });

    Route::group(['prefix' => 'categories'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('cp.admin.category');
        Route::get('create', [CategoryController::class, 'create'])->name('cp.admin.category.create');
        Route::post('store', [CategoryController::class, 'store'])->name('cp.admin.category.store');
        Route::get('edit/{id}', [CategoryController::class, 'edit'])->name('cp.admin.category.edit');
        Route::post('update/{id}', [CategoryController::class, 'update'])->name('cp.admin.category.update');
    });

    Route::group(['prefix' => 'products'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('cp.admin.product');
        Route::get('create', [ProductController::class, 'create'])->name('cp.admin.product.create');
        Route::post('store', [ProductController::class, 'store'])->name('cp.admin.product.store');
        Route::get('replicate/{id}', [ProductController::class, 'replicate'])->name('cp.admin.product.replicate');
        Route::get('edit/{id}', [ProductController::class, 'edit'])->name('cp.admin.product.edit');
        Route::post('update/{id}', [ProductController::class, 'update'])->name('cp.admin.product.update');
        Route::post('prop/store', [PropertyController::class, 'store'])->name('cp.admin.product.property.store');
        Route::post('image/store', [ProductController::class, 'storeImage'])->name('cp.admin.product.image.store');
        Route::post('image/delete', [ProductController::class, 'destroyImage'])->name('cp.admin.product.image.delete');
        Route::post('image/sort', [ProductController::class, 'sortImage'])->name('cp.admin.product.image.sort');
    });

    Route::group(['prefix' => 'shops'], function () {
        Route::get('/', [ShopController::class, 'index'])->name('cp.admin.shop');
        Route::get('create', [ShopController::class, 'create'])->name('cp.admin.shop.create');
        Route::post('store', [ShopController::class, 'store'])->name('cp.admin.shop.store');
        Route::get('edit/{id}', [ShopController::class, 'edit'])->name('cp.admin.shop.edit');
        Route::post('update/{id}', [ShopController::class, 'update'])->name('cp.admin.shop.update');
        Route::group(['prefix' => 'operators', 'as' => 'cp.admin.shop.operator.'], function () {
            Route::get('/{id}', [ShopOperatorController::class, 'index'])->name('index');
            Route::get('{id}/create', [ShopOperatorController::class, 'create'])->name('create');
            Route::post('store', [ShopOperatorController::class, 'store'])->name('store');
            Route::get('edit/{id}', [ShopOperatorController::class, 'edit'])->name('edit');
            Route::post('update/{id}', [ShopOperatorController::class, 'update'])->name('update');
        });

    });

    Route::group(['prefix' => 'finance-companies'],function() {
        Route::get('/',[FinanceCompanyController::class, 'index'])->name('cp.admin.finance_company.index');
        Route::get('create', [FinanceCompanyController::class, 'create'])->name('cp.admin.finance_company.create');
        Route::post('store', [FinanceCompanyController::class, 'store'])->name('cp.admin.finance_company.store');
        Route::get('edit/{id}', [FinanceCompanyController::class, 'edit'])->name('cp.admin.finance_company.edit');
        Route::post('update/{id}', [FinanceCompanyController::class, 'update'])->name('cp.admin.finance_company.update');
        Route::group(['prefix' => 'operators'],function() {
            Route::get('/{id}',[CompanyOperatorController::class, 'index'])->name('cp.admin.finance_company.operators');
            Route::get('{id}/create', [CompanyOperatorController::class, 'create'])->name('cp.admin.finance_company.operators.create');
            Route::post('store', [CompanyOperatorController::class, 'store'])->name('cp.admin.finance_company.operators.store');
            Route::get('edit/{id}', [CompanyOperatorController::class, 'edit'])->name('cp.admin.finance_company.operators.edit');
            Route::post('update/{id}', [CompanyOperatorController::class, 'update'])->name('cp.admin.finance_company.operators.update');
        });
    });

    Route::group(['prefix' => 'product-blocks'], function() {
        Route::get('/',[BlockController::class, 'index'])->name('cp.admin.product_blocks.index');
        Route::get('create',[BlockController::class, 'create'])->name('cp.admin.product_blocks.create');
        Route::post('store',[BlockController::class, 'store'])->name('cp.admin.product_blocks.store');
        Route::get('edit/{id}',[BlockController::class, 'edit'])->name('cp.admin.product_blocks.edit');
        Route::post('update/{id}',[BlockController::class, 'update'])->name('cp.admin.product_blocks.update');
        Route::post('destroy/{id}',[BlockController::class, 'destroy'])->name('cp.admin.product_blocks.destroy');
        Route::get('positions/edit',[BlockController::class, 'editPositions'])->name('cp.admin.product_blocks.edit.positions');
        Route::post('positions/update',[BlockController::class, 'updatePositions'])->name('cp.admin.product_blocks.update.positions');
    });

    Route::group(['prefix' => 'static-pages'], function () {
        Route::get('/', [StaticPageController::class, 'index'])->name('cp.admin.page');
        Route::get('create', [StaticPageController::class, 'create'])->name('cp.admin.page.create');
        Route::post('store', [StaticPageController::class, 'store'])->name('cp.admin.page.store');
        Route::get('edit/{id}', [StaticPageController::class, 'edit'])->name('cp.admin.page.edit');
        Route::post('update/{id}', [StaticPageController::class, 'update'])->name('cp.admin.page.update');
    });
    Route::group(['prefix' => 'editor-image'], function () {
        Route::post('get-all', [EditorImageController::class, 'getAll'])->name('cp.admin.editor-image');
        Route::post('store', [EditorImageController::class, 'saveImage'])->name('cp.admin.editor-image.store');
        Route::post('delete', [EditorImageController::class, 'deleteImage'])->name('cp.admin.editor-image.delete');
    });
});
