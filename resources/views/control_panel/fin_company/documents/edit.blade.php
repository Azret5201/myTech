@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Редактирование {{$document->name}}</h3>
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="{{ route('cp.fin.documents.index') }}">
                            {!! \App\Enum\Icons::BACK() !!}Назад
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <form action="{{ route('cp.fin.documents.update' , $document->id) }}" method="post" id="form" class="ajax row">
                    <div class="col-md-6">
                        <fieldset>
                            <legend>Документы</legend>
                            <div class="mb-3">
                                <label class="form-label">Название *</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       placeholder="Пример: Бытовая техника" value="{{$document->name}}"required>
                                <div class="invalid-feedback"></div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Описание *</label>
                                <input type="text" class="form-control" name="description" id="description"
                                       required value="{{$document->description}}">
                                <div class="invalid-feedback"></div>
                            </div>


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
