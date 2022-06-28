@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Создание операторов финансовой компании</h3>
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="{{ route('cp.admin.finance_company.operators', $company->id) }}">
                            {!! \App\Enum\Icons::BACK() !!}Назад
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <form action="{{ route('cp.admin.finance_company.operators.store') }}" method="post" >
                    @csrf
                    <div class="col-md-12">
                        <fieldset>
                            <legend>Операторы</legend>
                            <div class="mb-3">
                                <label class="form-label" for="name">Имя *</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       placeholder="Ваше имя">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label" for="email">E-mail *</label>
                                <input type="text" class="form-control" name="email" id="email"
                                       placeholder="Ваш email">
                                <div class="invalid-feedback"></div>
                            </div>
                            <input type="hidden" name="company_id" id="company_id" value="{{$company->id}}">
                            <div class="mb-3">
                                <label class="form-label" for="password">Пароль *</label>
                                <input type="password" class="form-control" name="password" required id="password"
                                       placeholder="Введите пароль">
                                <div class="invalid-feedback"></div>
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
