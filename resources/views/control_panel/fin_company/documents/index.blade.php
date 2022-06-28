@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Документы</h3>

                <ul class="nav nav-pills card-header-pills justify-content-end">
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('cp.fin.documents.create') }}">
                            Создать
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px;vertical-align: middle">#</th>
                        <th style="vertical-align: middle">Название</th>
                        <th class="" style="vertical-align: middle">Описание</th>
                        <th class="" style="vertical-align: middle;width:100px">Действие</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($documents)
                        @foreach($documents as $document)

                            <tr id="credit_product_{{ $document->id }}">
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $document->name }}
                                </td>
                                <td class="">
                                    {{$document->description}}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('cp.fin.documents.edit', $document->id) }}">Изменить</a>
                                </td>
                            </tr>
                        @endforeach
                    @endisset
                    </tbody>
                </table>
            </div>
        </div>
        <!-- Content here -->
    </div>
@endsection
