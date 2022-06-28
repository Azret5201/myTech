@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Продукты</h3>
                <ul class="nav nav-pills card-header-pills">

                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="{{ route('cp.admin.product.create') }}">
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
                        <th class="text-center">@sortablelink('category.name', 'Категории')</th>
                        <th class="text-center" style="width: 100px">@sortablelink('brand.name', 'Бренд')</th>
                        <th>@sortablelink('name', 'Название')</th>
                        <th class="text-center" style="width: 100px">@sortablelink('created_at', 'Дата')</th>
                        <th class="text-center" style="width: 100px">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @isset($products)
                        @foreach($products as $product)
                            <tr id="category_{{ $product->id }}">
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td class="text-center">
                                    {{ $product->category->name }}
                                </td>
                                <td class="text-center">
                                    {{ $product->brand->name }}
                                </td>
                                <td>
                                    {{ $product->name }}
                                </td>
                                <td class="text-center" style="width: 100px">
                                    {{ $product->created_at->format('d.m.Y') }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('cp.admin.product.edit', $product->id) }}">{!! \App\Enum\Icons::EDIT() !!}</a>
                                    <a href="{{ route('cp.admin.product.replicate', $product->id) }}">{!! \App\Enum\Icons::COPY() !!}</a>
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
