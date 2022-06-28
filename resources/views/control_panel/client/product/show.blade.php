@extends('layouts.includes.app')
@section('content')
    <main class="main mb-10 pb-1">
        <nav class="breadcrumb-nav container">
            <ul class="breadcrumb bb-no">
                <li><a href="{{ route('main') }}">Гавная страница</a></li>
                <li>Продукты</li>
            </ul>
        </nav>

        <div class="page-content">
            <div class="container">
                <div class="row gutter-lg">
                        <div class="product product-single row mb-2">
                            <div class="col-md-5 mb-4 mb-md-8">
                                <div class="product-gallery product-gallery-sticky">
                                    <div class="swiper-container product-single-swiper swiper-theme nav-inner"
                                         data-swiper-options="{
                                            'navigation': {
                                                'nextEl': '.swiper-button-next',
                                                'prevEl': '.swiper-button-prev'
                                            }
                                        }">
                                        <div class="swiper-wrapper row cols-1 gutter-no">
                                            @foreach($product->images as $image)
                                            <div class="swiper-slide">
                                                <figure class="product-image">
                                                    <img
                                                        src="{{ asset($image->getPath()) }}"
                                                        data-zoom-image="{{ asset($image->getPath()) }}"
                                                        alt="Classic Simple Backpack" width="800" height="900">
                                                </figure>
                                            </div>
                                            @endforeach
                                        </div>
                                        <button class="swiper-button-next"></button>
                                        <button class="swiper-button-prev"></button>

                                    </div>
                                    <div class="product-thumbs-wrap swiper-container" data-swiper-options="{
                                            'navigation': {
                                                'nextEl': '.swiper-button-next',
                                                'prevEl': '.swiper-button-prev'
                                            }
                                        }">
                                        <div class="product-thumbs swiper-wrapper row cols-4 gutter-sm">
                                        @foreach($product->images as $image)
                                            <div class="product-thumb swiper-slide">
                                                <img
                                                    src="{{ asset($image->getPath()) }}"
                                                    alt="Product Thumb" width="800" height="900">
                                            </div>
                                        @endforeach
                                        </div>
                                        <button class="swiper-button-next"></button>
                                        <button class="swiper-button-prev"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-7 mb-6 mb-md-8 col-sm-12">
                                <div class="product-details" data-sticky-options="{'minWidth': 767}">
                                    <h1 class="product-title">{{ $product->name }}</h1>
                                    <div class="product-bm-wrapper">
                                        <div class="product-meta">
                                            <div class="product-categories">
                                                Категория:
                                                <span class="product-category"><a
                                                        href="#">{{ $product->category->name }}</a></span>
                                            </div>
                                            <div class="product-sku">
                                                Артикул: <span>{{ $product->vendor_code }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <hr class="product-divider">
                                    <div class="shop-carts">
                                        <table class="shop-table wishlist-table" style="width: 100%;">
                                            <thead>
                                            <tr>
                                                <th class=""><span>Поставщики</span></th>
                                                <th class="wishlist-action">Свойства</th>
                                                <th class="wishlist-action"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($product->users as $user_product)
                                                @foreach($user_product->user->shops as $key => $shopOperator)
                                                    <tr>
                                                        <td class=" border-top text-center">
                                                            <a href="{{ route('shop.show', $shopOperator->storeShop->slug) }}">
                                                            <h4 class="font-weight-normal">{{ $shopOperator->storeShop->name }}</h4>
                                                            </a>
                                                        </td>
                                                        <td class=" border-top style mr-0 ml-0">
                                                            <div class="">
                                                            @foreach($user_product->userProductProperties as $props)

                                                                    <p class="mb-0 ">
                                                                        <span class="font-weight-bold">{{ $props->defaultProperty->name }}:</span>
                                                                        <span class="">
                                                                            {{ $props->value }}
                                                                        </span>
                                                                    </p>
                                                                    <input type="hidden" id="{{ $props->defaultProperty->is_price ? 'price-'.$shopOperator->storeShop->id : '' }}" value="{{ $props->defaultProperty->is_price ? $props->value : '' }}">
                                                                @endforeach

                                                            </div>
                                                        </td>
                                                        <td class="product-quantity border-top text-center">
                                                            <div class="row pl-lg-3 mt-xl-3" style="width: 270px;">
                                                                <div class="col-8">
                                                                    <div class="input-group mb-3">
                                                                        <input class="quantity border-color form-control" id="quanProduct-{{ $shopOperator->storeShop->id }}" type="number" min="1"
                                                                               max="3">
                                                                        <button class="quantity-plus cart-quantity w-icon-plus"></button>
                                                                        <button class="quantity-minus cart-quantity w-icon-minus"></button>
                                                                    </div>
                                                                </div>
                                                                <div class="col-4">
                                                                    @if(count($product->users) > 1)
                                                                        <div>
                                                                            <input type="radio" class="option-input radio shopChecked"  name="shop" data-id="{{ $shopOperator->storeShop->id }}" onclick="getShopId()" checked  />
                                                                        </div>
                                                                    @else
                                                                        <input type="hidden" id="shopId" data-id="{{ $shopOperator->storeShop->id }}">

                                                                    @endif
                                                                </div>
                                                            </div>

                                                        </td>

                                                    </tr>
                                                @endforeach
                                            @endforeach

                                            </tbody>
                                        </table>

                                    </div>
                                    <div class="">
                                        <button class="btn btn-primary btn-style btn-cart" data-id="{{ $product->id }}" id="addToCart">
                                            <i class="w-icon-cart"></i>
                                            <span>Купить</span>
                                        </button>
                                    </div>
                                    <div class="product-short-desc mt-3">
                                        <p><span class="sub-title font-weight-bold">Параметры</span></p>
                                        <ul class="list-type-check list-style-none">
                                            @foreach($product->productProperties as $property)
                                                @if(!$property->should_user_fill)
                                                    <li>{{ $property->propName->name .': '. $property->value }}</li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                    <hr class="product-divider">
                                </div>
                            </div>
                        </div>

                        <section class="description-section">
                            <div class="title-link-wrapper no-link">
                                <h2 class="title title-link">Описание</h2>
                            </div>
                            <div class="pt-4 pb-1" id="product-tab-description">
                                {!! $product->description !!}
                            </div>
                        </section>

                    <!-- End of Main Content -->
                </div>
            </div>
        </div>
    </main>
@endsection

@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('vendor/wolmart/vendor/photoswipe/photoswipe.min.css') }}">
    <link rel="stylesheet" type="text/css"
          href="{{ asset('vendor/wolmart/vendor/photoswipe/default-skin/default-skin.min.css') }}">
    <style>
        .product-single .btn-cart {
            margin-bottom: 0px !important;
            min-width: 6rem !important;
            padding-left: 3px;
        }

        .input-group button {
            right: 0.5rem;
        }
        .shop-carts {
            background-color: #FFD898;
            border-radius: 12px;
            padding: 12px;
            border: 1px solid #ed711b;
        }
        .cart-quantity {
            background-color: white !important;
        }
        .border-top {
            border-top-color: #FFA303 !important;
            border-bottom:1px solid #FFA303 !important;
        }
        .border-color {
            border: 1px solid #FFA303 !important;
        }
        .btn-style {
            padding-left: 40px !important;
            padding-right: 40px !important;
            float: right;
            margin-top: 10px;
        }

        .style {
            width: 1%;
            white-space: nowrap;
        }
        .option-input {
            -webkit-appearance: none;
            -moz-appearance: none;
            -ms-appearance: none;
            -o-appearance: none;
            appearance: none;
            position: relative;
            top: 5px;
            right: 0;
            bottom: 0;
            left: 13px;
            height: 30px;
            width: 30px;
            transition: all 0.15s ease-out 0s;
            background: #cbd1d8;
            border: none;
            color: #fff;
            cursor: pointer;
            display: inline-block;
            margin-right: 0.5rem;
            outline: none;
            position: relative;
            z-index: 1000;
        }
        .option-input:hover {
            background: #9faab7;
        }
        .option-input:checked {
            background: #ed711b;
        }
        .option-input:checked::before {
            height: 30px;
            width: 32px;
            position: absolute;
            content: '✔';
            display: inline-block;
            font-size: 26.66667px;
            text-align: center;
            line-height: 30px;
        }
        .option-input:checked::after {
            -webkit-animation: click-wave 0.65s;
            -moz-animation: click-wave 0.65s;
            animation: click-wave 0.65s;
            background: #40e0d0;
            content: '';
            display: block;
            position: relative;
            z-index: 100;
        }
        .option-input.radio {
            border-radius: 50%;
        }
        .option-input.radio::after {
            border-radius: 50%;
        }
    </style>
@endpush

@push('scripts')
    <script src="{{ asset('vendor/wolmart/vendor/sticky/sticky.min.js') }}"></script>
    <script src="{{ asset('vendor/wolmart/vendor/photoswipe/photoswipe.min.js') }}"></script>
    <script src="{{ asset('vendor/wolmart/vendor/photoswipe/photoswipe-ui-default.min.js') }}"></script>

    <script>
        window.addEventListener("load", function(event) {
            getShopId();
        });
        function getShopId()
        {
            let checkedShop;
            if($('input:radio').length !== 0){
                $("input:radio:checked").each(function(){
                    checkedShop = $(this).data("id");
                });
            }
            else {
                checkedShop = $('#shopId').data('id');
            }

            return checkedShop;
        }

        $(document).on('click', '#addToCart', function (e) {
            let productId = $(this).data('id');
            let checkedId = getShopId();
            let quanProduct = $('#quanProduct-' + checkedId).val();
            let price = document.getElementById("price-"+checkedId).value;
            console.log(price);
            $.ajax({
                method: 'get',
                url: '{{ route('addProduct.toCart') }}',
                data: {
                    _token: '{{ csrf_token() }}',
                    productId: productId,
                    shopId: checkedId,
                    quantity: quanProduct,
                    price: price
                },
                success: function (){
                    console.log('product was add successfully');
                },
                error: function (){
                    console.log('product was not add successfully');

                }
            })
        });
    </script>
@endpush
