@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Создание блоков</h3>
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="{{ route('cp.admin.product_blocks.index') }}">
                            {!! \App\Enum\Icons::BACK() !!}Назад
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <form action="{{ route('cp.admin.product_blocks.store') }}" method="post" id="form" class="ajax row">
                    <div class="col-md-6">
                        <fieldset>
                            <legend>Блоки</legend>
                            <div class="mb-3">
                                <label class="form-label">Название *</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       placeholder="Пример: Бытовая техника" >
                                <div class="invalid-feedback"></div>
                            </div>

                            <input type="hidden" name="position" value="{{$blocks->count() + 1}}">
                            <div class="mb-3">
                                <label class="form-label">Товары для блока *</label>
                                <div class="form-check">
                                    @isset($products)
                                        @foreach($products as $product)
                                            <input class="form-check-input" type="checkbox" name="products[]"
                                                   id="{{$product->id}}"
                                                   value="{{$product->id}}">
                                            <label class="form-check-label" for="{{$product->id}}">
                                                {{$product->name ." ( ". $product->category->name . " ) "}}
                                            </label>
                                        @endforeach
                                    @endisset

                                </div>
                            </div>

                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked"
                                       name="display" checked>
                                <label class="form-check-label" for="flexSwitchCheckChecked">Отображать на сайте</label>
                            </div>
                        </fieldset>
                    </div>

                    <div>
                        <button id="sub1" class="btn btn-success" type="submit">
                            Сохранить
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endsection
        @push('scripts')
    @endpush
