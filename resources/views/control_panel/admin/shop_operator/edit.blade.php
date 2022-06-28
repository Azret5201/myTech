@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Создание операторов магазина</h3>
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="{{ route('cp.admin.shop.operator.index', $operator->entity_id) }}">
                            {!! \App\Enum\Icons::BACK() !!}Назад
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <form action="{{ route('cp.admin.shop.operator.update', $operator->id) }}" method="post" >
                    @csrf
                    <div class="col-md-12">
                        <fieldset>
                            <legend>Операторы</legend>
                            <div class="mb-3">
                                <label class="form-label" for="name">Имя *</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       placeholder="Ваше имя" value="{{ $operator->user->name }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">E-mail *</label>
                                <input type="text" class="form-control" name="email" id="email"
                                       placeholder="Ваш email" value="{{ $operator->user->email }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3 row">
                                <div class="form-group mb-3 col">
                                    <label class="form-check form-switch">
                                        <input type="checkbox" name="shop_admin" class="form-check-input"
                                               @if($operator->is_administrator) checked @endif>
                                        <span class="form-check-label">Администратор</span>
                                    </label>
                                </div>
                                <div class="form-group mb-3 col">
                                    <label class="form-check form-switch">
                                        <input type="checkbox" name="shop_operator_active" class="form-check-input"
                                               @if($operator->user->active) checked @endif>
                                        <span class="form-check-label">Активный</span>
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                    <div>
                        <button class="btn btn-success" type="submit">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Content here -->
    </div>
@endsection
