@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Категории</h3>
                <ul class="nav nav-pills card-header-pills">

                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="{{ route('cp.admin.category.create') }}">
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
                        <th class="text-center" style="width: 100px">Комиссия</th>
                        <th class="text-center" style="width: 100px">Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @isset($categories)
                        @foreach($categories as $category)
                            <tr id="category_{{ $category->id }}">
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ str_repeat('- ', $category->depth) }}{{ $category->name }}
                                </td>
                                <td class="text-center">
                                    {{ $category->percent }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('cp.admin.category.edit', $category->id) }}">{!! \App\Enum\Icons::EDIT() !!}</a>
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
