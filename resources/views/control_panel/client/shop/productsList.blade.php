@foreach($products as $product)
    <div class="product-wrap">
        <div class="product product-simple text-center">
            <figure class="product-media">
                <a href="{{ route('shop.product.show', ['slug' => $shop->slug, 'productSlug' => $product->slug]) }}">
                    <img src="{{ asset($product->images->first() ? $product->images->first()->getPath() : asset('app/img/no-image.jpg')) }}"
                         alt="Product"
                         width="300" height="338"/>
                </a>
{{--                <div class="product-action-vertical">--}}
{{--                    <a href="#"--}}
{{--                       class="btn-product-icon btn-wishlist w-icon-heart"--}}
{{--                       title="Add to wishlist"></a>--}}
{{--                    <a href="#"--}}
{{--                       class="btn-product-icon btn-compare w-icon-compare"--}}
{{--                       title="Add to Compare"></a>--}}
{{--                </div>--}}
{{--                <div class="product-action">--}}
{{--                    <a href="#" class="btn-product btn-quickview"--}}
{{--                       title="Quick View">Quick--}}
{{--                        View</a>--}}
{{--                </div>--}}
            </figure>
            <div class="product-details">
                <h4 class="product-name"><a href="product-default.html">
                        {{ $product->category->name }}
                    </a></h4>
                <div class="ratings-container">
                    <div class="ratings-full">
                        <span class="ratings" style="width: 100%;"></span>
                        <span class="tooltiptext tooltip-top"></span>
                    </div>
                    <a href="product-default.html" class="rating-reviews">(3
                        reviews)</a>
                </div>
                <div class="product-pa-wrapper">
                    <div
                        class="product-price">{{ $product->getMinPrice() }} сом/месяц</div>
                    <div class="product-action">
                        <a href="#"
                           class="btn-cart btn-product btn btn-icon-right btn-link btn-underline">Добавить
                            в корзину</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
