@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Создание магазина</h3>
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="{{ route('cp.admin.shop') }}">
                            {!! \App\Enum\Icons::BACK() !!}Назад
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <form action="{{ route('cp.admin.shop.update', $shop->id) }}" method="post" class="ajax row">
                    <div class="col-md-6">
                        <fieldset>
                            <legend>Магазин</legend>
                            <div class="mb-3">
                                <label class="form-label">Название *</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       placeholder="Пример: Household Appliances" value="{{ $shop->name ?? '' }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Описание</label>
                                <div class="col-12 form-control"
                                     id="text_blocks.editor">
                                    @isset($shop->description)
                                        {!! $shop->description  !!}
                                    @endisset
                                </div>
                                <input type="hidden" name="text" id="text"
                                       class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset class="row">
                            <legend>Контакты</legend>
                            <div class="mb-3">

                                <label class="form-label">Адрес</label>
                                <input type="text" class="form-control" name="address" id="address"
                                       placeholder="Пример: ул.Чуй" value="{{ $shop->address ?? '' }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group mb-3">
                                    <label for="select2Multiple">Контакты</label>
                                    <select class="select2-multiple form-control" name="contacts[]" multiple="multiple" id="select2Multiple">
                                        @foreach($shop->contacts as $contact)
                                            <option value="{{ $contact }}" selected>{{ $contact }}</option>>
                                        @endforeach
                                    </select>
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
@push('scripts')
    <script>
        $(document).ready(function () {
            $('.select2-multiple').select2({
                placeholder: "Введите контакты продавца",
                tags: true,
            });
        });
    </script>
@endpush
