@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header justify-content-between">
                <h3 class="card-title">Операторы магазина : {{$shop->name}}</h3>
                <div class="my-2 my-md-0 flex-grow-1 flex-md-grow-0 order-first order-md-last">
                    <ul class="nav nav-pills card-header-pills">
                        <li class="nav-item ms-auto">
                            <a class="nav-link" href="{{ route('cp.admin.shop', $shop->id ) }}">
                                {!! \App\Enum\Icons::BACK() !!}
                            </a>
                        </li>
                        <li class="nav-item ms-auto">
                            <a class="nav-link" href="{{ route('cp.admin.shop.operator.create', $shop->id ) }}">
                                {!! \App\Enum\Icons::PLUS() !!}
                            </a>
                        </li>
                    </ul>
                </div>
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
                                <td class="text-center">
                                    {{ $operator->created_at->format('d.m.Y') }}
                                </td>
                                <td class="text-center">
                                    @if($operator->is_administrator)
                                        {!! \App\Enum\Icons::CHECK() !!}
                                    @else
                                        {!! \App\Enum\Icons::CLOSE() !!}
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('cp.admin.shop.operator.edit', $operator->id) }}">{!! \App\Enum\Icons::EDIT() !!}</a>
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
