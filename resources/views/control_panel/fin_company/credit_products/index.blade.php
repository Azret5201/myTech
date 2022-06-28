@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Кредитные продукты</h3>

                <ul class="nav nav-pills card-header-pills justify-content-end">
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('cp.fin.credit_products.create') }}">
                            Создать
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;vertical-align: middle">#</th>
                        <th style="vertical-align: middle">Название</th>
                        <th class="text-center " style="width: 100px;vertical-align: middle">Мин сумма</th>
                        <th class="text-center" style="width: 100px;vertical-align: middle">Макс сумма</th>
                        <th class="text-center" style="width: 100px;vertical-align: middle">Cтавка</th>
                        <th class="text-center" style="width: 100px;vertical-align: middle">Выдача</th>
                        <th class="text-center" style="width: 100px;vertical-align: middle">Обналичивание</th>
                        <th class="text-center" style="width: 100px;vertical-align: middle">Действия</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($credit_products)
                        @foreach($credit_products as $product)

                            <tr id="credit_product_{{ $product->id }}">
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $product->name }}
                                </td>
                                <td class="text-center">
                                    {{$product->min_sum}}
                                </td>
                                <td class="text-center">
                                    {{$product->max_sum}}
                                </td>
                                <td class="text-center">
                                    {{$product->cash_withdrawal_fee}}
                                </td>
                                <td class="text-center">
                                    {{$product->annual_interest_rate}}
                                </td>
                                <td class="text-center">
                                    {{$product->issuance_fee}}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('cp.fin.credit_products.edit', $product->id) }}">Изменить</a>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Content here -->
    </div>
@endsection
