@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Просмотр заказа</h3>
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="{{ route('orders.index') }}">
                            {!! \App\Enum\Icons::BACK() !!}Назад
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">

                    <div class="col-md-12">
                        <fieldset>
                            <legend>Пользователь</legend>
                            <div class="mb-3">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th style="vertical-align: middle">ФИО</th>
                                        <th class="text-center" style="vertical-align: middle;width:150px">Телефон</th>
                                        <th class="text-center" style="vertical-align: middle;width:100px">Email</th>
                                        <th class="text-center" style="vertical-align: middle;width:200px">Зарегестрирован</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                            <tr>
                                                <td>
                                                    {{$order->name}}
                                                </td>
                                                <td class="text-center">
                                                    {{$order->phone}}
                                                </td>
                                                <td class="text-center">
                                                    {{$order->email}}
                                                </td>

                                                <td class="text-center">
                                                    @if(isset($order->user)){{$order->user->created_at->format('d.m.Y')}}@else{{"-"}}@endif
                                                </td>
                                            </tr>
                                    </tbody>
                                </table>
                                <p class="h4">Загруженные документы</p>
                                <div class="d-flex">
                                @foreach($order->images as $image)
                                        <img src="{{asset("storage/images/".$image->original_name )}}" width="300">
                                @endforeach
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-12">
                        <fieldset>
                            <legend>Заказ</legend>
                            <div class="mb-3">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th style="vertical-align: middle; width:20px" class="text-center">#</th>
                                        <th  style="vertical-align: middle;width:150px">Название</th>
                                        <th class="text-center" style="vertical-align: middle;width:100px">Кол-во</th>
                                        <th class="text-center" style="vertical-align: middle;width:200px">Сумма</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order->productOrders as $product)

                                    <tr>
                                        <td class="text-center">
                                           1
                                        </td>
                                        <td>
                                            {{$product->product->name}}
                                        </td>
                                        <td class="text-center">
                                            {{$product->amount}}
                                        </td>

                                        <td class="text-center">
                                            {{$order->total}}
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </fieldset>
                    </div>

                    <div class="col-md-12">
                        <fieldset>
                            <legend>Магазин</legend>
                            <div class="mb-3">
                                <table class="table table-bordered table-sm">
                                    <thead>
                                    <tr>
                                        <th style="vertical-align: middle; width:20px" class="text-center">#</th>
                                        <th  style="vertical-align: middle;width:150px">Название</th>
                                        <th class="text-center" style="vertical-align: middle;width:100px">Контакты</th>
                                        <th class="text-center" style="vertical-align: middle;width:200px">Адрес</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td class="text-center">
                                            1
                                        </td>
                                        <td >
                                            {{$order->productOrder->shop->name}}
                                        </td>
                                        <td class="text-center">
                                            @foreach($order->productOrder->shop->contacts as $contact)
                                                {{$contact}}
                                            @endforeach
                                        </td>

                                        <td class="text-center">
                                            {{$order->productOrder->shop->address}}
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </fieldset>
                    </div>
                <form action="{{ route('orders.update' , $order->id) }}" method="post"  class="ajax row">
                    @csrf
                    @method('put')
                    <label>Статус</label>
                    <select class="custom-select custom-select-lg mb-3 form-control" id="status" name="status">
                        @foreach(\App\Enum\FinStatusOrder::toTitlesArray() as $id => $status)

                        <option value="{{$id}}" @if($order->creditProductOrders->status_id == $id){{'selected'}} @endif  class="form-control">
                            {{$status}}
                        </option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback"></div>
                    <div id="status_div" class="d-none mb-2">
                        <textarea name="status_text" class ="form-control" id="status_text" rows="4" cols="50">
                            {{$order->creditProductOrders->status_text}}
                        </textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div>
                    <button id="sub1" class="btn btn-success" type="submit">
                            Сохранить
                    </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')

        <script>
            document.addEventListener('DOMContentLoaded', () => {
                const n = document.getElementById('status').value;
                if(n == 3)
                {
                    let status_div = document.getElementById('status_div');
                    status_div.classList.add('d-block');
                    status_div.classList.remove('d-none');
                }else{
                    let status_div = document.getElementById('status_div');
                    status_div.classList.remove('d-block');
                    status_div.classList.add('d-none');
                }
            });


            let div = document.getElementById('status');
            div.addEventListener('change', function() {
                let  n = this.value;
                console.log(this.value);
                if(n == 3)
                {
                    let status_div = document.getElementById('status_div');
                    status_div.classList.add('d-block');
                    status_div.classList.remove('d-none');
                }else{
                    let status_div = document.getElementById('status_div');
                    status_div.classList.remove('d-block');
                    status_div.classList.add('d-none');
                }
            });
        </script>
@endpush
