@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Товарные блоки</h3>

                <ul class="nav nav-pills card-header-pills justify-content-end">

                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('cp.admin.product_blocks.create') }}">
                            {!! \App\Enum\Icons::PLUS() !!}
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('cp.admin.product_blocks.edit.positions') }}">
                            Изменить позицию
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px">#</th>
                        <th>Название блока</th>
                        <th class="text-center" style="width: 100px">Товаров</th>
                        <th class="text-center" style="width: 100px">Статус</th>
                        <th class="text-center" style="width: 100px">Действия</th>
                    </tr>
                    </thead>
                    <tbody>

                    @isset($blocks)
                        @foreach($blocks as $block)

                            <tr id="category_{{ $block->id }}">
                                <td class="text-center">
                                    {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $block->name }}
                                </td>
                                <td class="text-center">
                                   {{$block->products->count()}}
                                </td>
                                <td class="text-center">
                                    @if( $block->display )
                                        {{ "На сайте" }}
                                    @else
                                        {{"Выключен"}}
                                    @endif
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('cp.admin.product_blocks.edit', $block->id) }}">{!! \App\Enum\Icons::EDIT() !!}</a>
                                    <form action="{{ route('cp.admin.product_blocks.destroy', $block->id) }}" class="ajax" method="post">
                                        <button class="button-delete"  type="submit">Удалить</button>
                                    </form>
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
