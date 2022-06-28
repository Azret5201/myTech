@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    Редактировать
                    @if($operator->is_administrator === 1)
                       администратора
                    @else
                        оператора
                    @endif
                </h3>
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="{{ route('cp.admin.finance_company.operators', $operator->entity_id) }}">
                            {!! \App\Enum\Icons::BACK() !!}Назад
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <form action="{{ route('cp.admin.finance_company.operators.update', $operator->id) }}" method="post" >
                    <div class="col-md-12">
                       @csrf
                        <fieldset>

                            <legend>
                                @if($operator->is_administrator === 1)
                                    администратор
                                @else
                                    оператор
                                @endif
                            </legend>
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
                            <div class="mb-3">
                                <label class="form-check-label form-label" for="flexSwitchCheckDefault">Администратор</label>
                            <div class="form-check form-switch">

                                <input class="form-check-input" name="is_administrator"type="checkbox"  @if($operator->is_administrator === 1) {{'checked'}} @endif  id="flexSwitchCheckDefault">
                                <div class="invalid-feedback"></div>
                            </div>
                            </div>

                        </fieldset>
                    </div>
                    <div>
                        <button id="handle-click" class="btn btn-success" type="submit">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Content here -->
    </div>
@endsection
