@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Создание финансовой компании</h3>
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="{{ route('cp.admin.finance_company.index') }}">
                            {!! \App\Enum\Icons::BACK() !!}Назад
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body row row-cards">
                <div class="col-lg-12">
                    <form action="{{ route('cp.admin.finance_company.store') }}" method="post" class="ajax">
                        <div class="mb-3">
                            <label class="form-label">Название *</label>
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder="Пример: Red Bear">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Телефон *</label>
                            <input type="text" name="phone" id="phone"
                                   class="form-control" placeholder="Пример: +996707665500">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Адрес *</label>
                            <input type="text" class="form-control" name="address" id="address"
                                   placeholder="Пример: Московская 32" >
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Сайт</label>
                            <input type="text" class="form-control" name="site" id="site"
                                   placeholder="Пример: redbear.com" >
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Instagram</label>
                            <input type="text" class="form-control" name="instagram" id="instagram"
                                   placeholder="Пример: www.instagram.com" >
                            <div class="invalid-feedback"></div>
                        </div>
                        <button id="handle-click"  class="btn btn-success" type="submit">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Content here -->
    </div>

@endsection
