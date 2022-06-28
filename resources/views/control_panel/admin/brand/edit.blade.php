@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Редактирование брэнда</h3>
                <ul class="nav nav-pills card-header-pills">

                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="{{route('cp.admin.brand')}}">
                            {!! \App\Enum\Icons::BACK() !!}Назад
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <form action="{{ route('cp.admin.brand.update', $brand->id) }}" method="post" class="ajax">
                    <div class="mb-3">
                        <label class="form-label">Название *</label>
                        <input type="text" value="{{ $brand->name }}" class="form-control" name="name" placeholder="Пример: Lenovo">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Описание</label>
                        <div class="col-12 form-control"
                             id="text_blocks.editor">
                            {!! $brand->description  !!}
                        </div>
                        <input type="hidden" name="text" id="text"
                               class="form-control">
                        <div class="invalid-feedback"></div>
                    </div>
                    <button  class="btn btn-success" type="submit">Сохранить</button>
                </form>
            </div>
        </div>
        <!-- Content here -->
    </div>
@endsection
