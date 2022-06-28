@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Редактирование финансовых компаний</h3>
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
                    <form id='form' action="{{ route('cp.admin.finance_company.update', $company->id) }}" method="post" >
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Название *</label>
                            <input type="text" class="form-control" name="name" id="name"
                                   placeholder="Пример: Бытовая техника"
                                   value="{{ $company->name }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Телефон *</label>
                            <input type="text" name="phone" id="phone"
                                   class="form-control" placeholder="Пример: +996707665500" value="{{ $company->phone }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Адрес *</label>
                            <input type="text" class="form-control" name="address" id="address"
                                   placeholder="Пример: Московская 32" value="{{ $company->address }}" >
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Сайт</label>
                            <input type="text" class="form-control" name="site" id="site"
                                   placeholder="Пример: redbear.com" value="{{ $company->site }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Instagram</label>
                            <input type="text" class="form-control" name="instagram" id="instagram"
                                   placeholder="Пример: www.instagram.com" value="{{ $company->instagram }}">
                            <div class="invalid-feedback"></div>
                        </div>
                        <button  class="btn btn-success"  type="submit">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
        <!-- Content here -->
    </div>
@endsection
