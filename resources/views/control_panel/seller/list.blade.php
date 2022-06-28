@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="row card-header m-0">
                <div class="col-lg-12 pb-2">
                    <h3 class="card-title">Ваш ассортимент</h3>
                </div>
                <div class="col-lg-10 ">
                    <div class="form-group">
                        <input type="text" class="form-control typeahead"
                               placeholder="Введите наименование продукта">
                    </div>
                </div>
                <div class="col-lg-2 ps-3">
                    <button id="search-btn" data-id="" class="btn text-white w-100 border-0"
                            style="background: #782DF6">
                        Далее
                    </button>
                </div>
            </div>

            <div class="table-list">
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <th class="text-center" style="width: 80px">#</th>
                        <th>Наименование</th>
                        <th class="text-center" style="width: 80px">Брэнд</th>
                        <th class="text-center" style="width: 80px">Количество</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($userProducts as $userProduct)

                        <tr>
                            <td class="text-center" style="width: 80px">{{ $loop->iteration }}</td>
                            <td>{{ $userProduct->product->name }}</td>
                            <td class="text-center" style="width: 80px">{{ $userProduct->product->brand->name }}</td>
                            <td class="text-center" style="width: 80px">{{ $userProduct->quantity }}</td>

                            <td>
                                <a href="{{ route('product.edit.properties', $userProduct->id) }}">Изменить</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    <nav aria-label="Page navigation example">
                        @if ($userProducts->lastPage() > 1)
                            <ul class="pagination">
                                <li class="{{ ($userProducts->currentPage() == 1) ? ' disabled' : '' }} page-item p-2">
                                    <a href="{{ $userProducts->url(1) }}" class="page-link" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                    </a>
                                </li>
                                @for ($i = 1; $i <= $userProducts->lastPage(); $i++)
                                    <li class="{{ ($userProducts->currentPage() == $i) ? ' active' : '' }} page-item p-2">
                                        <a href="{{ $userProducts->url($i) }}" class="page-link">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="{{ ($userProducts->currentPage() == $userProducts->lastPage()) ? ' disabled' : '' }} page-item p-2">
                                    <a href="{{ $userProducts->url($userProducts->currentPage()+1) }}" class="page-link"
                                       aria-label="Next">
                                        <span aria-hidden="true">&raquo;</span>
                                    </a>
                                </li>
                            </ul>
                        @endif
                    </nav>
                </div>
            </div>

        </div>
        <!-- Content here -->
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.js"
            integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"
            integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13"
            crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"
            integrity="sha512-HWlJyU4ut5HkEj0QsK/IxBCY55n5ZpskyjVlAoV9Z7XQwwkqXoYdCIC93/htL3Gu5H3R4an/S0h2NXfbZk3g7w=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const path = "{{ route('search.product') }}";
        $('input.typeahead').typeahead({
            source: function (terms, process) {
                return $.get(path, {terms: terms}, function (data) {
                    return process(data);
                });
            },
            afterSelect: function (data) {
                $('#search-btn').data('id', data.id);
            }
        });
        $('#search-btn').click(function () {
            let id = $(this).data('id');
            window.location.href = '/cp/seller/assortments/product/' + id;
        })
    </script>

@endpush
