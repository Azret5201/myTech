@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Заказы</h3>
            </div>
            <form method="get" action="">
                <div class="form-row align-items-center container ">
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Фильтр заказов</label>
                        <select class="form-control" name="filter">
                            <option value="0">Все</option>
                            <option value="1">В работе</option>
                            <option value="2">Архивированные</option>
                        </select>

                        <div class="col-auto my-1">
                            <button type="submit" class="btn btn-primary">Фильтровать</button>
                        </div>
                    </div>

                </div>
            </form>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;vertical-align: middle">#</th>
                        <th style="vertical-align: middle">ФИО</th>
                        <th class="text-center" style="vertical-align: middle;width:150px">Телефон</th>
                        <th class="text-center" style="vertical-align: middle;width:100px">Сумма</th>
                        <th class="text-center" style="vertical-align: middle;width:200px">Продавец</th>
                        <th class="text-center" style="vertical-align: middle;width:80px">Действие</th>

                    </tr>
                    </thead>
                    <tbody>

                    @isset($credit_product_orders)
                        @foreach($credit_product_orders as $credit_product)
                            <tr id="credit_product_{{ $credit_product->order->id }}">
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $credit_product->order->name }}
                                </td>
                                <td class="text-center">
                                    {{$credit_product->order->phone}}
                                </td>
                                <td class="text-center">
                                    {{$credit_product->order->total}}
                                </td>
                                <td class="text-center">
                                    {{$credit_product->order->productOrder->shop->name}}
                                </td>
                                <td class="text-center">
                                    <a href="{{route('orders.edit', $credit_product->order->id)}}">Открыть</a>
                                    <form action="{{ route('orders.archive' , $credit_product->order->id) }}" method="post"  class="ajax row">
                                        @csrf
                                        @method('put')
                                        <div>
                                            <button class="button-update" type="submit">
                                                @if($credit_product->is_archive != 1)
                                                    {{'Архивировать'}}
                                                @else
                                                    {{'Разархивировать'}}
                                                @endif
                                            </button>
                                        </div>
                                    </form>
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
