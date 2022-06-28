@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Финансовые компании</h3>
                <ul class="nav nav-pills card-header-pills">

                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="{{ route('cp.admin.finance_company.create') }}">
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
                        <th class="text-center" style="width: 100px">Операторы</th>
                        <th class="text-center" style="width: 100px">Телефон</th>
                        <th class="text-center" style="width: 100px">Действия</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($companies)
                        @foreach($companies as $company)

                            <tr id="category_{{ $company->id }}">
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $company->name }}
                                </td>
                                <td class="text-center">
                                    <a href="{{route('cp.admin.finance_company.operators', $company->id) }}">{{$company->operators->count()}}</a>
                                </td>
                                <td class="text-center">
                                    {{ $company->phone }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('cp.admin.finance_company.edit', $company->id) }}">{!! \App\Enum\Icons::EDIT() !!}</a>
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
