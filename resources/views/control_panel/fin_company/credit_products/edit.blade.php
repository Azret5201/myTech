@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Редактирование {{$product->name}}</h3>
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="{{ route('cp.fin.credit_products.index') }}">
                            {!! \App\Enum\Icons::BACK() !!}Назад
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <form action="{{ route('cp.fin.credit_products.update' , $product->id) }}" method="post" id="form" class="ajax row">
                    <div class="col-md-6">
                        <fieldset>
                            <legend>Кредитные продукты</legend>
                            <div class="mb-3">
                                <label class="form-label">Название *</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       placeholder="Пример: Бытовая техника" value="{{$product->name}}"required>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Минимальная сумма *</label>
                                <input type="number" step="0.01"  class="form-control" name="min_sum" id="min_sum"
                                       required value="{{$product->min_sum}}">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Максимальная сумма *</label>
                                <input type="number" step="0.01" class="form-control" name="max_sum" id="max_sum"
                                       required value="{{$product->max_sum}}" >
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"> Минимальный срок кредитования в днях *</label>
                                <input type="number" class="form-control" name="min_loan_term" id="min_loan_term"
                                       required value="{{$product->min_loan_term}}">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"> Максимальный срок кредитования в днях *</label>
                                <input type="number" class="form-control" name="max_loan_term" id="max_loan_term"
                                       required value="{{$product->max_loan_term}}">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"> Комиссия за выдачу *</label>
                                <input type="number" step="0.01" class="form-control" name="issuance_fee" id="issuance_fee"
                                       required value="{{$product->issuance_fee}}">
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"> Комиссия за обналичивание *</label>
                                <input type="number" step="0.01" class="form-control" name="cash_withdrawal_fee" id="cash_withdrawal_fee"
                                       required value="{{$product->cash_withdrawal_fee}}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label"> Годовая % ставка *</label>
                                <input type="number" step="0.01" class="form-control" name="annual_interest_rate" id="annual_interest_rate"
                                       required value="{{$product->annual_interest_rate}}">
                                <div class="invalid-feedback"></div>
                            </div>
                            @isset($documents)
                                <div class="mb-3">
                                    <label class="form-label">Документы *</label>
                                    <div class="form-check">
                                        @foreach($documents as $document)

                                            <input class="form-check-input" type="checkbox" {{$product->documents->contains($document->id) ? 'checked' : '' }}   name="documents[]"
                                                   id="{{$document->id}}"
                                                   value="{{$document->id}}">
                                            <label class="form-check-label" for="{{$document->id}}">
                                                {{$document->name }}
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endisset



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
