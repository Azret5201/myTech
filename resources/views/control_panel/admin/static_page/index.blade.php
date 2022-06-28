@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Статические страницы</h3>
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="{{ route('cp.admin.page.create') }}">
                            {!! \App\Enum\Icons::PLUS() !!}
                        </a>
                    </li>
                </ul>
            </div>
            <table class="table table-bordered table-sm">
                <thead>
                <tr>
                    <th class="text-center" style="width: 80px">#</th>
                    <th>Название</th>
                    <th class="text-center" style="width: 100px">Дата</th>
                    <th class="text-center" style="width: 100px">Действия</th>
                </tr>
                </thead>
                <tbody>

                @foreach($items as $item)
                    <tr >
                        <td class="text-center" style="width: 80px">{{ $loop->iteration }}</td>
                        <td>{{ $item->name }}</td>
                        <td class="text-center" style="width: 100px">{{ $item->created_at->format('d.m.Y') }}</td>
                        <td class="text-center" style="width: 100px">
                            <a href="{{ route('cp.admin.page.edit', $item->id) }}">{!! \App\Enum\Icons::EDIT() !!}</a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <!-- Content here -->
    </div>
@endsection
