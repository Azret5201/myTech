<?php

use App\Http\Controllers\ControlPanel\Auth\LoginController;

use App\Http\Controllers\ControlPanel\FinCompany\Auth\CompanyLoginController;
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

Route::get('cp/login', [LoginController::class, 'getLogin'])->name('cp.auth.login.get');
Route::post('cp/login', [LoginController::class, 'postLogin'])->name('cp.auth.login.post');
Route::get('cp/logout', [LoginController::class, 'logout'])->name('cp.logout');


Route::get('company/login',[CompanyLoginController::class, 'getLogin'])->name('company.auth.login.get');
Route::post('company/login', [CompanyLoginController::class, 'postLogin'])->name('company.auth.login.post');

Route::group([
    'middleware' => 'company_admin'
], function () {
    Route::get('/index', [CompanyLoginController::class, 'home'])->name('company.dashboard');
});

Route::get('demo7', function (){
    return view('layouts.includes.main');
});



