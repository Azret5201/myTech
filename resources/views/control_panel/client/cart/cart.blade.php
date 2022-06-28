@extends('layouts.includes.app')
@section('content')
    <main class="main cart">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb shop-breadcrumb bb-no">
                    <li class="active"><a href="{{ route('cart') }}">Корзина</a></li>
{{--                    <li><a href="checkout.html">Оформление заказа</a></li>--}}
{{--                    <li><a href="order.html">Заказ завершен</a></li>--}}
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->
        <!-- Start of PageContent -->
        <div class="page-content">
            <div class="container">
                <div class="row gutter-lg mb-10">
                    <div class="col-lg-8 pr-lg-4 mb-6 ">
                        <div class="cart-data">
                        @if(!session('cart') || empty(session('cart')))
                                <div class="page-header" id="emptyDiv" style="background-color: #eee">
                                    <div class="container">
                                        <h1 class="page-title mb-0">Корзина пуста</h1>
                                    </div>
                                </div>
                        @else
                            <table class="shop-table cart-table">
                                <thead>
                                <tr>
                                    <th class="product-name"><span>Продукт</span></th>
                                    <th></th>
                                    <th class="product-price"><span>Цена</span></th>
                                    <th class="product-quantity"><span>Количество</span></th>
                                    <th class="product-subtotal"><span>Итог</span></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach(session()->get('cart') as $id => $shopProducts)

                                    @foreach($shopProducts as $prodId => $product)
                                        <tr class="title-{{ $id }}">
                                            <td colspan="5"><h3>Продавец: {{ $product['shop'] }}</h3></td>
                                        </tr>
                                        <tr>
                                            <td class="product-thumbnail">
                                                <div class="p-relative">
                                                    <a href="#">
                                                        <figure>
                                                            <img src="{{ asset($product['image']) }}" alt="product"
                                                                 width="300" height="338">
                                                        </figure>
                                                    </a>
                                                    <button type="submit" class="btn btn-close" data-shop="{{ $id }}" data-product="{{ $prodId }}"><i
                                                            class="fas fa-times"></i></button>
                                                </div>
                                            </td>

                                            <td class="product-name">
                                                <a href="product-default.html">
                                                    {{ $product['name'] }}
                                                </a>
                                            </td>

                                            <td class="product-price"><span class="amount">{{ $product['price'] }}</span></td>
                                            <td class="product-quantity">
                                                <div class="input-group">
                                                    <input class=" form-control quantityValue-{{ $id .'-'. $prodId}}" type="number" min="1" max="3" value="{{ $product['quantity'] }}">
                                                    <button class="quantity-plus w-icon-plus" data-shop="{{ $id }}" data-product="{{ $prodId }}"></button>
                                                    <button class="quantity-minus w-icon-minus" data-shop="{{ $id }}" data-product="{{ $prodId }}"></button>
                                                </div>
                                            </td>
                                            <td class="product-subtotal">
                                                <span class="amount subtotalProd-{{ $id .'-'. $prodId}}">{{ $product['subtotal'] }}</span>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                        </div>
                        <div class="cart-action mb-6">
                            <button type="submit" class="btn btn-rounded btn-default btn-clear mr-auto" name="clear_cart" value="Clear Cart">Очистить корзину</button>
                            <a href="{{ route('main') }}" class="btn btn-dark btn-rounded btn-icon-right btn-shopping ">Продолжить покупки<i class="w-icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-lg-4 sticky-sidebar-wrapper">
                        <div class="sticky-sidebar">
                            <div class="cart-summary mb-4">
                                <h3 class="cart-title text-uppercase">Итоги корзины</h3>


                                <hr class="divider mb-6">
                                <div class="order-total d-flex justify-content-between align-items-center">
                                    <label>Итог</label>
                                    <span class="ls-50" id="total">{{ session()->get('total') }}</span>
                                </div>
                                <a href="{{route('order.create')}}"
                                   class="btn btn-block btn-dark btn-icon-right btn-rounded  btn-checkout">
                                    Перейдите к оформлению заказа<i class="w-icon-long-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of PageContent -->
    </main>
@endsection

@push('scripts')

    <script>
        $(document).on('click', '.w-icon-plus', function (e){
            let shopId = $(this).data('shop');
            let productId = $(this).data('product');
            let increment = 1;
            let val = $('.quantityValue-' + shopId + '-' + productId).val();
            if (val < 3) {
                updateCart(shopId, productId, increment)
            }
            else{
                $(this).addClass('disabled')
            }
        })

        $(document).on('click', '.w-icon-minus', function (e){
            let shopId = $(this).data('shop');
            let productId = $(this).data('product');
            let decrement = 0;
            let val = $('.quantityValue-' + shopId + '-' + productId).val();
            if (val > 1) {
                updateCart(shopId, productId, decrement)
            }
            else{
                $(this).addClass('disabled')
            }

        })

        function updateCart(shopId, productId, type) {

            $.ajax({
                method: "put",
                url: '{{ route('update.cart') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    shopId: shopId,
                    productId: productId,
                    type: type
                },
                success: function (data) {
                    if (data.increment) {
                        $('.quantityValue-' + shopId + '-' + productId).get(0).value++;
                        $('.subtotalProd-' + shopId + '-' + productId).text(data.subtotal)
                        $('#total').text(data.total)
                    } else {
                        $('.quantityValue-' + shopId + '-' + productId).get(0).value--;
                        $('.subtotalProd-' + shopId + '-' + productId).text(data.subtotal)
                        $('#total').text(data.total)

                    }
                }

            })
        }

        $(document).on('click', '.btn-close', function (e) {
            let prodId = $(this).data('product');
            let shopId = $(this).data('shop');

            $.ajax({
                url: '{{ route('delete.product') }}',
                method: 'delete',
                data: {
                    _token: '{{ csrf_token() }}',
                    prodId: prodId,
                    shopId: shopId
                },
                success: function (data){
                    $(e.currentTarget).parent().parent().parent().closest('tr').remove();
                    $('.title-'+shopId).closest('tr').remove();
                    if ($('.cart-table tr').length === 1)
                    {
                        let div = $('<div class="page-header" id="emptyDiv" style="background-color: #eee"><div class="container"> <h1 class="page-title mb-0">Корзина пуста</h1> </div></div>');
                        $('.cart-data').html(div);
                    }
                    $('#total').text(data.total)

                }
            })
        })

        $(document).on('click', '.btn-clear', function (e) {
            $.ajax({
                url: '{{ route('clear.cart') }}',
                method: 'delete',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function (data){
                    let div = $('<div class="page-header" id="emptyDiv" style="background-color: #eee"><div class="container"> <h1 class="page-title mb-0">Корзина пуста</h1> </div></div>');
                    $('.cart-data').html(div);
                    $('#total').text(data.total)

                }
            })
        })
    </script>
@endpush
