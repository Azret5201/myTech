@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Редактирование позиций блоков</h3>
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="{{ route('cp.admin.product_blocks.index') }}">
                            {!! \App\Enum\Icons::BACK() !!}Назад
                        </a>
                    </li>
                </ul>
            </div>


        <div class="container-xl">
            <!-- Page title -->
            <form action="{{ route('cp.admin.product_blocks.update.positions') }}" method="post" id="form" class="ajax row">
            <div class="card">

                <div class="card-body">
                    <table class="table table-bordered table-sm">
                        <thead>
                        <tr>
                            <th class="text-center" style="width: 80px">#</th>
                            <th>Название блока</th>
                            <th class="text-center" style="width: 100px">Статус</th>
                            <th class="text-center" style="width: 100px">Позиция</th>
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
                                        @if( $block->display )
                                            {{ "На сайте" }}
                                        @else
                                            {{"Выключен"}}
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <input style="width: 4em;" type="number" value="{{ $loop->iteration }}" name="positions[]"/>
                                    </td>
                                </tr>
                            @endforeach
                        @endisset
                        </tbody>
                    </table>
                    <div>
                        <button  class="btn btn-success" type="submit">
                            Сохранить
                        </button>
                    </div>
                </div>

            </div>

            </form>
            <!-- Content here -->
        </div>
@endsection
@push('scripts')
@endpush
