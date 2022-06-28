@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Магазины</h3>
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="{{ route('cp.admin.shop.create') }}">
                            {!! \App\Enum\Icons::PLUS() !!}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px">#</th>
                        <th>Название</th>
                        <th class="text-center">Адрес</th>
                        <th class="text-center" style="width: 100px">Операторы</th>
                        <th class="text-center" style="width: 100px">Дата</th>
                        <th class="text-center" style="width: 100px">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @isset($shops)
                        @foreach($shops as $shop)
                            <tr id="category_{{ $shop->id }}">
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $shop->name }}
                                </td>
                                <td class="text-center">
                                    {{ $shop->address }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('cp.admin.shop.operator.index',  $shop->id) }}">                                    {{ count($shop->operators) }}
                                    </a>
                                </td>
                                <td class="text-center" style="width: 100px">
                                    {{ $shop->created_at->format('d.m.Y') }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('cp.admin.shop.edit', $shop->id) }}">{!! \App\Enum\Icons::EDIT() !!}</a>
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
