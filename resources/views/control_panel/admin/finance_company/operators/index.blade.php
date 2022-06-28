@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Операторы финансовой компании : {{$company->name}}</h3>
                <ul class="nav nav-pills card-header-pills list-group">
                    <li class="nav-item ms-auto">
                        <a class="nav-link"
                           href="{{ route('cp.admin.finance_company.operators.create',$company->id ) }}">
                            {!! \App\Enum\Icons::PLUS() !!}
                        </a>
                    </li>
                    <li class="nav-item ms-auto">
                        <a class="nav-link"
                           href="{{ route('cp.admin.finance_company.index' ) }}">
                            {!! \App\Enum\Icons::BACK() !!}
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px">#</th>
                        <th>Имя</th>
                        <th class="text-center">Email</th>
                        <th class="text-center" style="width: 100px">Дата</th>
                        <th class="text-center" style="width: 100px">Администратор</th>
                        <th class="text-center" style="width: 100px">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @isset($operators)
                        @foreach($operators as $operator)
                            <tr id="category_{{ $operator->id }}">
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $operator->user->name }}
                                </td>
                                <td class="text-center">
                                    {{ $operator->user->email }}
                                </td>
                                <td class="text-center" style="width: 100px">
                                    {{ $operator->created_at->format('d.m.Y') }}
                                </td>
                                <td class="text-center" style="width: 100px">
                                    @if($operator->is_administrator)
                                        {!! \App\Enum\Icons::CHECK() !!}
                                    @else
                                        {!! \App\Enum\Icons::CLOSE() !!}
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('cp.admin.finance_company.operators.edit', $operator->id) }}">{!! \App\Enum\Icons::EDIT() !!}</a>
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
