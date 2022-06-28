@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Создание брэнда</h3>
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="{{route('cp.admin.brand')}}">
                            {!! \App\Enum\Icons::BACK() !!}Назад
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <fieldset>
                            <legend>Создание брэнда</legend>
                            <form action="{{ route('cp.admin.brand.store') }}" method="post" class="ajax">
                                <div class="mb-3">
                                    <label class="form-label">Название *</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Пример: Lenovo">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Описание</label>
                                    <div class="col-12 form-control"
                                         id="text_blocks.editor">
                                    </div>
                                    <input type="hidden" name="text" id="text"
                                           class="form-control">
                                    <div class="invalid-feedback"></div>
                                </div>
                                <button id="handle-click" class="btn btn-success" type="submit">Создать</button>
                            </form>
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset>
                            <legend>Массовое создание брэндов</legend>
                        <form action="{{ route('cp.admin.brand.mass_store') }}" method="post" class="ajax">
                            <div class="mb-3">
                                <label class="form-label" for="brands"> Брэнды</label>
                                <textarea name="brands" id="brands" class="form-control" data-bs-toggle="autosize" placeholder="Каждый брэнд с новой строки" style="overflow: hidden; overflow-wrap: break-word; resize: none; height: 54px;"></textarea>
                                <div class="invalid-feedback"></div>
                            </div>

                            <button id="handle-click" class="btn btn-success" type="submit">Создать</button>
                        </form>
                        </fieldset>
                    </div>
                </div>

            </div>
        </div>
        <!-- Content here -->
    </div>
@endsection