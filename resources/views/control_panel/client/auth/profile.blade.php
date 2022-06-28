
@extends('layouts.includes.app')
@section('content')

<div class="my-account">
<main class="main">
    <!-- Start of Page Header -->
    <div class="page-header">
        <div class="container">
            <h1 class="page-title mb-0">Мой профиль</h1>

        </div>
    </div>
    <!-- End of Page Header -->

    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('main') }}">Главная страница</a></li>
                <li>Мой профиль</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of PageContent -->
    <div class="page-content pt-2">
        <div class="container">
            <div class="tab tab-vertical row gutter-lg">
                <ul class="nav nav-tabs mb-6" role="tablist">
                    <li class="nav-item">
                        <a href="#account-dashboard" class="nav-link {{ count($errors) ? '' : 'active'  }}">Панель</a>
                    </li>
                    <li class="nav-item">
                        <a href="#account-orders" class="nav-link">Мои заказы</a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a href="#account-downloads" class="nav-link">Downloads</a>--}}
{{--                    </li>--}}
{{--                    <li class="nav-item">--}}
{{--                        <a href="#account-addresses" class="nav-link">Addresses</a>--}}
{{--                    </li>--}}
                    <li class="nav-item">
                        <a href="#account-details" class="nav-link {{ count($errors) ? 'active' : ''  }}">Личные данные</a>
                    </li>
{{--                    <li class="nav-item">--}}
{{--                        <a href="wishlist.html" class="nav-link">Wishlist</a>--}}
{{--                    </li>--}}
                    <li class="nav-item">
                        <a onclick="document.getElementById('logout-form-auth').submit();" class="nav-link">Выйти</a>

                        <form id="logout-form-auth" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>

                <div class="tab-content mb-6">
                    <div class="tab-pane {{ count($errors) ? '' : 'active'  }} in" id="account-dashboard">
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                <a href="#account-orders" class="link-to-tab">
                                    <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-orders">
                                                    <i class="w-icon-orders"></i>
                                                </span>
                                        <div class="icon-box-content">
                                            <p class="text-uppercase mb-0">Заказы</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                <a href="#account-details" class="link-to-tab">
                                    <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-account">
                                                    <i class="w-icon-user"></i>
                                                </span>
                                        <div class="icon-box-content">
                                            <p class="text-uppercase mb-0">Личные данные</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">


                                <a onclick="document.getElementById('logout-form-auth').submit();">
                                    <div class="icon-box text-center">
                                                <span class="icon-box-icon icon-logout">
                                                    <i class="w-icon-logout"></i>
                                                </span>
                                        <div class="icon-box-content">
                                            <p class="text-uppercase mb-0">Выйти</p>
                                        </div>
                                    </div>
                                </a>
                                <form id="logout-form-auth" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane mb-4" id="account-orders">
                        <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-orders">
                                        <i class="w-icon-orders"></i>
                                    </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title text-capitalize ls-normal mb-0">Orders</h4>
                            </div>
                        </div>

                        <table class="shop-table account-orders-table mb-6">
                            <thead>
                            <tr>
                                <th class="order-id">Order</th>
                                <th class="order-date">Date</th>
                                <th class="order-status">Status</th>
                                <th class="order-total">Total</th>
                                <th class="order-actions">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="order-id">#2321</td>
                                <td class="order-date">August 20, 2021</td>
                                <td class="order-status">Processing</td>
                                <td class="order-total">
                                    <span class="order-price">$121.00</span> for
                                    <span class="order-quantity"> 1</span> item
                                </td>
                                <td class="order-action">
                                    <a href="#"
                                       class="btn btn-outline btn-default btn-block btn-sm btn-rounded">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="order-id">#2321</td>
                                <td class="order-date">August 20, 2021</td>
                                <td class="order-status">Processing</td>
                                <td class="order-total">
                                    <span class="order-price">$150.00</span> for
                                    <span class="order-quantity"> 1</span> item
                                </td>
                                <td class="order-action">
                                    <a href="#"
                                       class="btn btn-outline btn-default btn-block btn-sm btn-rounded">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="order-id">#2319</td>
                                <td class="order-date">August 20, 2021</td>
                                <td class="order-status">Processing</td>
                                <td class="order-total">
                                    <span class="order-price">$201.00</span> for
                                    <span class="order-quantity"> 1</span> item
                                </td>
                                <td class="order-action">
                                    <a href="#"
                                       class="btn btn-outline btn-default btn-block btn-sm btn-rounded">View</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="order-id">#2318</td>
                                <td class="order-date">August 20, 2021</td>
                                <td class="order-status">Processing</td>
                                <td class="order-total">
                                    <span class="order-price">$321.00</span> for
                                    <span class="order-quantity"> 1</span> item
                                </td>
                                <td class="order-action">
                                    <a href="#"
                                       class="btn btn-outline btn-default btn-block btn-sm btn-rounded">View</a>
                                </td>
                            </tr>
                            </tbody>
                        </table>

                        <a href="shop-banner-sidebar.html" class="btn btn-dark btn-rounded btn-icon-right">Go
                            Shop<i class="w-icon-long-arrow-right"></i></a>
                    </div>

                    <div class="tab-pane {{ count($errors) ? 'active' : ''  }}" id="account-details">
                        <div class="icon-box icon-box-side icon-box-light">
                                    <span class="icon-box-icon icon-account mr-2">
                                        <i class="w-icon-user"></i>
                                    </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title mb-0 ls-normal">Account Details</h4>
                            </div>
                        </div>
                        <form class=" account-details-form ajax" action="{{ route('change.password') }}" method="post" autocomplete="off">
                            @csrf
                            @method('put')
                            <div class="form-group mb-6">
                                <label for="name">ФИО</label>
                                <input type="text" id="name" name="name" value="{{ auth()->user()->name }}"
                                       class="form-control form-control-md">
                            </div>

                            <div class="invalid-feedback"></div>
                            <div class="form-group mb-6">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="{{ auth()->user()->email }}"
                                       class="form-control form-control-md disabled">
                            </div>

                            <h4 class="title title-password ls-25 font-weight-bold">Смена пароля</h4>
                            <div class="form-group">
                                <label class="text-dark" for="current_password">Введите текущий пароль</label>
                                <input type="password" class="form-control form-control-md"
                                       id="current_password" name="current_password" autocomplete="new-password">
                                    <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group">
                                <label class="text-dark" for="new-password">Введите новый пароль</label>
                                <input type="password" class="form-control form-control-md"
                                       id="new_password" name="new_password">
                                <span class="invalid-feedback"></span>
                            </div>
                            <div class="form-group mb-10">
                                <label class="text-dark" for="conf-password">Подвердите новый пароль</label>
                                <input type="password" class="form-control form-control-md"
                                       id="confirm_password" name="confirm_password">
                                <span class="invalid-feedback" role="alert"></span>
                            </div>
                            <button type="submit" class="btn btn-dark btn-rounded btn-sm mb-4">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End of PageContent -->
</main>
</div>

@endsection
@push('styles')
    <link rel="stylesheet" href="{{ asset('vendor/tabler/css/tabler-vendors.min.css') }}">
    <style>
        .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
            border-bottom: 1px solid #eee;
            border-top: none;
            border-right: none;
            border-left: none;

        }
        .tab-vertical .nav-link {
            padding-left: 0;
            padding-right: 0;
            margin-bottom: 0;
        }
        .nav-tabs .nav-link {
            border-bottom: 1px solid #eee;
        }
        .nav-tabs .nav-link:focus, .nav-tabs .nav-link:hover {
            border-bottom: 1px solid #eee; !important;
            border-top: none  !important;
            border-right: none !important;
            border-left: none !important;
        }
        a:hover {
            color: #ed711b;
        }
        .disabled {
            pointer-events:none;
        }
    </style>
@endpush


