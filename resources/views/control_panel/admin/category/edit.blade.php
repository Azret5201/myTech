@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Редактирование категории</h3>
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="{{ route('cp.admin.category') }}">
                            {!! \App\Enum\Icons::BACK() !!}Назад
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body row row-cards">
                <div class="col-lg-12">
                    <form action="{{ route('cp.admin.category.update', $category->id) }}" method="post" class="ajax">
                        <div class="mb-3">
                            <label class="form-label">Название *</label>
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder="Пример: Бытовая техника"
                                   value="{{ $category->name }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label for="">Родительская категория</label>
                            <select class="form-control" name="parent_id">
                                <option value="">-- Главная категория --</option>
                                @foreach($categories as $categoryAsOption)
                                    <option value="{{ $categoryAsOption->id }}"{{ $category->parent_id == $categoryAsOption->id ? ' selected' : '' }}>{{ str_repeat('- ', $categoryAsOption->depth) }}{{ $categoryAsOption->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Описание</label>
                            <div class="col-12 form-control"
                                 id="text_blocks.editor">
                                {!! $category->description  !!}
                            </div>
                            <input type="hidden" name="text" id="text"
                                   class="form-control">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Размер комиссии</label>
                            <input type="number" class="form-control" name="percent" id="percent"
                                   placeholder="Пример: 16" value="{{ $category->percent }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <button id="handle-click" class="btn btn-success" type="submit">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Content here -->
    </div>
@endsection
