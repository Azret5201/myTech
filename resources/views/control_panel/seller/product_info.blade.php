@extends('layouts.control_panel.master')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Редактирование продукта</h3>
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="{{ route('listProducts') }}">
                            Назад
                        </a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-6 p-3">
                    <fieldset>
                        <legend>Информация о продукте</legend>
                        <div class="row mt-2">
                            <div class="col-12 border-bottom-5">
                            </div>
                            <div class="col-5 pt-2 border-5">
                                <span class="font-weight-bold font-size-18">Наименование товара:</span>
                            </div>
                            <div class="col-7 pt-2">
                                <span class="font-size-18">{{ $product->name }}</span>
                            </div>
                            <div class="col-5 pt-2 font-size-18">
                                <span class="font-weight-bold">Описание:</span>
                            </div>
                            <div class="col-7 pt-2 font-size-18">
                                <span>{{ $product->desccription }}</span>
                            </div>
                            <div class="col-5 pt-2 font-size-18">
                                <span class="font-weight-bold">Артикул:</span>
                            </div>
                            <div class="col-7 pt-2 font-size-18">
                                <span>{{ $product->vendor_code }}</span>
                            </div>
                            <div class="col-5 pt-2 font-size-18">
                                <span class="font-weight-bold">Брэнд:</span>
                            </div>
                            <div class="col-7 pt-2 font-size-18">
                                <span>{{ $product->brand->name }}</span>
                            </div>
                        </div>
                    </fieldset>
                </div>
                <div class="col-6 p-3">
                    @if(count($product->productProperties))

                        <fieldset>
                            <legend>Свойства продукта</legend>
                            <div class="row">
                                @include('control_panel.seller.create_edit_props', ['type'=>$type])
                            </div>

                        </fieldset>

                    @endif
                </div>
            </div>
        </div>
    </div>






@endsection









