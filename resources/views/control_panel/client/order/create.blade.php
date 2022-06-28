@extends('layouts.includes.app')
@section('content')

    <div class="container">
        <!-- Page title -->
        <div class="card mt-4 mb-4" >
            <div class="card-header">
                <h4 class="text-center">Оформление заказа</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('order.store') }}" method="post" class="ajax">
                    <div class="col-md-12">
                        <fieldset class="fieldset">
                            <legend class="legend">Оформление заказа</legend>
                            @if(Auth()->user())
                            @if(Auth()->user()->type_id != 5)
                            <div class="mb-3">
                                <label class="form-label" style="font-weight:bold">Имя *</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       placeholder="Пример: Азамат" >
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label"  style="font-weight:bold">Email *</label>
                                <input type="text" class="form-control" name="email" id="email"
                                       placeholder="Пример: azamat@gmail.com" >
                                <div class="invalid-feedback"></div>
                            </div>
                            @endif
                            @else
                                <div class="mb-3">
                                    <label class="form-label" style="font-weight:bold">Имя *</label>
                                    <input type="text" class="form-control" name="name" id="name"
                                           placeholder="Пример: Азамат" >
                                    <div class="invalid-feedback"></div>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label"  style="font-weight:bold">Email *</label>
                                    <input type="text" class="form-control" name="email" id="email"
                                           placeholder="Пример: azamat@gmail.com" >
                                    <div class="invalid-feedback"></div>
                                </div>
                            @endif
                            <div class="mb-3">
                                <label class="form-label"  style="font-weight:bold">Телефон *</label>
                                <input type="text" class="form-control" name="phone" id="phone"
                                       placeholder="Пример: 0555889944">
                                <div class="invalid-feedback"></div>
                            </div>

                            @isset($companies)
                            <div class="mb-3">
                                <label class="form-label"  style="font-weight:bold">Выберите финансовую компанию *</label><br>
                                @foreach($companies as $company)
                                    <label class="form-check-label" name="company_id"  style="font-weight:bold">
                                        {{$company->name }}
                                    </label>
                                    <div class="container " style="overflow-x:auto;">

                                        <table class="shop-table account-orders-table mb-6 ">
                                            <thead>
                                            <tr>
                                                <th class="text-center" style="width: 10px;vertical-align: middle">#</th>
                                                <th class="text-left">Название</th>
                                                <th class="text-center" style="width: 100px;vertical-align: middle">Cтавка</th>
                                                <th class="text-center" style="width: 100px;vertical-align: middle">Выдача</th>
                                                <th class="text-center" style="width: 100px;vertical-align: middle">Обналичивание</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($company->credit_products as $product)
                                                    <tr id="credit_product_{{ $product->id }}">
                                                        <td class="text-center">
                                                            <input class="form-check-input credit_product_documents " type="radio" name="credit_product_id"
                                                            id="credit_product_id"
                                                            value="{{$product->id}}" required>
                                                        </td>
                                                        <td>
                                                            {{ $product->name }}
                                                        </td>
                                                        <td class="text-center">
                                                            {{$product->cash_withdrawal_fee}}
                                                        </td>
                                                        <td class="text-center">
                                                            {{$product->annual_interest_rate}}
                                                        </td>
                                                        <td class="text-center">
                                                            {{$product->issuance_fee}}
                                                        </td>
                                                    </tr>

                                                @endforeach
                                                <div class="invalid-feedback"></div>
                                            </tbody>
                                        </table>

                                    </div>
                                    <br>
                                @endforeach
                            </div>
                            @endisset
                    <div class="col-md-12">
                        <fieldset class="fieldset">
                            <legend class="legend">Документы</legend>
                            <div class="mb-3" style="overflow-x:auto;">
                            <table class="shop-table account-orders-table mb-6 ">
                            <thead>
                            <tr>
                                <th class="text-center" style="width: 80px;vertical-align: middle">#</th>
                                <th class="text-left">Название</th>
                                <th class="" style="vertical-align: middle">Описание</th>
                                <th class="" style="vertical-align: middle; width:30px">Изображение</th>
                            </tr>
                            </thead>
                            <tbody id="document_body">

                            </tbody>
                        </table>
                            </div>
                        </fieldset>
                    </div>
                    <div>
                        <button id="sub1" class="btn btn-success" type="submit">
                            Сохранить
                        </button>
                    </div>
                        </fieldset>
                    </div>
                </form>
            </div>
        </div>
        </div>
@endsection
@push('scripts')
<script>
    let radios = document.querySelectorAll('input[type=radio][name="credit_product_id"]');
    let document_body = document.getElementById('document_body');
    for(let i = 0; i < radios.length; i++) {
        radios[i].addEventListener('change', async function () {
            let response = await axios.get(`/get/documents/${radios[i].value}`)
            document_body.innerHTML = "";

            if (response.data.documents) {
                response.data.documents.forEach((document, index) => {
                    document_body.innerHTML +=
                        `<tr >
                            <td class="text-center">${index+1}</td>
                            <td>${document.name}</td>
                            <td>${document.description}</td>
                            <td class="form-control">
                            <div class="btn-wrap ">

                                <input type="file"
                                       name="files[]"
                                       id="files"
                                       class="form-control "
                                       style="float:right;font-size:1rem" />
                                <div class="invalid-feedback"></div>
                            </div>
                            </td>
                        </tr>`;
                })
            }
        });
    }
</script>
@endpush
