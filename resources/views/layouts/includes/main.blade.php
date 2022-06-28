@extends('layouts.includes.app')

@section('content')
    <!-- start of .main -->
    <main class="main">
        <div class="page-content">
            <section class="intro-section">
                <div class="intro-slider swiper-container swiper-theme animation-slider" data-swiper-options="{
                        'slidesPerView': 1,
                        'autoplay': {
                            'delay': 8000,
                            'disableOnInteraction': false
                        }
                    }">
                    <div class="swiper-wrapper row cols-1 gutter-no">
                        <div class="swiper-slide banner banner-fixed intro-slide intro-slide1"
                             style="background-image: url({{ asset('/vendor/wolmart/images/demos/demo7/slides/slide-1.jpg') }}); background-color: #EEEDEB;">
                            <div class="container">
                                <div class="banner-content d-inline-block y-50">
                                    <div class="slide-animate" data-animation-options="{
                                            'name': 'fadeInUpShorter', 'duration': '1s'
                                        }">
                                        <h5 class="banner-subtitle text-uppercase font-weight-bold">
                                            Performance &amp; Lifestyle
                                        </h5>
                                        <h3 class="banner-title ls-25 mb-6">
                                            <span class="text-primary">Introducing</span>
                                            Fashion lifestyle collection
                                        </h3>
                                        <a href="shop-banner-sidebar.html"
                                           class="btn btn-dark btn-outline btn-rounded btn-icon-right">
                                            Shop Now<i class="w-icon-long-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Intro Slide 1 -->
                        <div class="swiper-slide banner banner-fixed intro-slide intro-slide2"
                             style="background-image: url({{ asset('/vendor/wolmart/images/demos/demo7/slides/slide-2.jpg') }}); background-color: #A9A9A9;">
                            <div class="container text-right">
                                <div class="banner-content y-50 d-inline-block">
                                    <div class="slide-animate" data-animation-options="{
                                            'name': 'zoomIn', 'duration': '1s'
                                        }">
                                        <h5 class="banner-subtitle text-uppercase font-weight-bold ls-25 mb-0">
                                            Up To <strong class="text-primary text-capitalize">30% Off</strong>
                                        </h5>
                                        <h3 class="banner-title text-white text-uppercase ls-25">Calisthenics</h3>
                                        <div class="banner-price-info text-white">Start at $125.00</div>
                                        <a href="shop-banner-sidebar.html"
                                           class="btn btn-white btn-outline btn-rounded btn-icon-right">
                                            Shop Now<i class="w-icon-long-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Intro Slide 2 -->
                        <div class="swiper-slide banner banner-fixed intro-slide intro-slide3"
                             style="background-image: url({{ asset('/vendor/wolmart/images/demos/demo7/slides/slide-3.jpg') }}); background-color: #F3F3F3;">
                            <div class="container">
                                <div class="banner-content y-50 d-inline-block">
                                    <div class="slide-animate" data-animation-options="{
                                            'name': 'fadeInDownShorter', 'duration': '1s'
                                        }">
                                        <h5 class="banner-subtitle text-uppercase text-primary font-weight-bold mb-1">
                                            From Online Store
                                        </h5>
                                        <h3 class="banner-title text-uppercase ls-25">Sprimgchic</h3>
                                        <h4 class="ls-25 mb-0">Recommend</h4>
                                        <p class="ls-25">Free shipping on all orders over <span
                                                class="text-dark">$99.00</span></p>
                                        <a href="shop-banner-sidebar.html"
                                           class="btn btn-dark btn-rounded btn-outline btn-icon-right">
                                            Shop Now<i class="w-icon-long-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Intro Slide 3 -->
                        <div class="swiper-slide banner banner-fixed intro-slide intro-slide1"
                             style="background-image: url({{ asset('/vendor/wolmart/images/demos/demo7/slides/slide-1.jpg') }}); background-color: #EEEDEB;">
                            <div class="container">
                                <div class="banner-content d-inline-block y-50">
                                    <div class="slide-animate" data-animation-options="{
                                            'name': 'fadeInUpShorter', 'duration': '1s'
                                        }">
                                        <h5 class="banner-subtitle text-uppercase font-weight-bold">
                                            Performance &amp; Lifestyle
                                        </h5>
                                        <h3 class="banner-title ls-25 mb-6">
                                            <span class="text-primary">Introducing</span>
                                            Fashion lifestyle collection
                                        </h3>
                                        <a href="shop-banner-sidebar.html"
                                           class="btn btn-dark btn-outline btn-rounded btn-icon-right">
                                            Shop Now<i class="w-icon-long-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Intro Slide 1 -->
                        <div class="swiper-slide banner banner-fixed intro-slide intro-slide3"
                             style="background-image: url('{{ asset('/vendor/wolmart/images/demos/demo7/slides/slide-3.jpg') }}'); background-color: #F3F3F3;">
                            <div class="container">
                                <div class="banner-content y-50 d-inline-block">
                                    <div class="slide-animate" data-animation-options="{
                                            'name': 'fadeInDownShorter', 'duration': '1s'
                                        }">
                                        <h5 class="banner-subtitle text-uppercase text-primary font-weight-bold mb-1">
                                            From Online Store
                                        </h5>
                                        <h3 class="banner-title text-uppercase ls-25">Sprimgchic</h3>
                                        <h4 class="ls-25 mb-0">Recommend</h4>
                                        <p class="ls-25">Free shipping on all orders over <span
                                                class="text-dark">$99.00</span></p>
                                        <a href="shop-banner-sidebar.html"
                                           class="btn btn-dark btn-rounded btn-outline btn-icon-right">
                                            Shop Now<i class="w-icon-long-arrow-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- End of Intro Slide 3 -->
                    </div>
                    <div class="custom-dots swiper-img-dots appear-animate">
                        <a href="#" class="active appear-animate">
                            <img src="{{ asset('/vendor/wolmart/images/demos/demo7/slides/dot-1.png') }}"
                                 alt="Slide Thumb" width="70"
                                 height="70">
                        </a>
                        <a href="#" class="appear-animate">
                            <img src="{{ asset('/vendor/wolmart/images/demos/demo7/slides/dot-2.png') }}"
                                 alt="Slide Thumb" width="70"
                                 height="70">
                        </a>
                        <a href="#" class="appear-animate">
                            <img src="{{ asset('/vendor/wolmart/images/demos/demo7/slides/dot-3.png') }}"
                                 alt="Slide Thumb" width="70"
                                 height="70">
                        </a>
                        <a href="#" class="appear-animate">
                            <img src="{{ asset('/vendor/wolmart/images/demos/demo7/slides/dot-4.png') }}"
                                 alt="Slide Thumb" width="70"
                                 height="70">
                        </a>
                        <a href="#" class="appear-animate">
                            <img src=" {{ asset('/vendor/wolmart/images/demos/demo7/slides/dot-3.png') }}"
                                 alt="Slide Thumb" width="70"
                                 height="70">
                        </a>
                    </div>
                </div>
            </section>

            <div class="container">
                <div class="swiper-container swiper-theme icon-box-wrapper appear-animate br-sm bg-white mb-10"
                     data-swiper-options="{
                        'loop': true,
                        'spaceBetween': 30,
                        'slidesPerView': 1,
                        'autoplay': {
                            'delay': 4000,
                            'disableOnInteraction': false
                        },
                        'breakpoints': {
                            '576': {
                                'slidesPerView': 2
                            },
                            '768': {
                                'slidesPerView': 2
                            },
                            '992': {
                                'slidesPerView': 3
                            },
                            '1200': {
                                'slidesPerView': 4
                            }
                        }}">
                    <div class="swiper-wrapper row cols-md-4 cols-sm-3 cols-1">
                        <div class="swiper-slide icon-box icon-box-side text-dark">
                                <span class="icon-box-icon icon-shipping">
                                    <i class="w-icon-truck"></i>
                                </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title font-weight-bolder ls-normal">Free Shipping & Returns</h4>
                                <p class="text-default">For all orders over $99</p>
                            </div>
                        </div>
                        <div class="swiper-slide icon-box icon-box-side text-dark">
                                <span class="icon-box-icon icon-payment">
                                    <i class="w-icon-bag"></i>
                                </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title font-weight-bolder ls-normal">Secure Payment</h4>
                                <p class="text-default">We ensure secure payment</p>
                            </div>
                        </div>
                        <div class="swiper-slide icon-box icon-box-side text-dark icon-box-money">
                                <span class="icon-box-icon icon-money">
                                    <i class="w-icon-money"></i>
                                </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title font-weight-bolder ls-normal">Money Back Guarantee</h4>
                                <p class="text-default">Any back within 30 days</p>
                            </div>
                        </div>
                        <div class="swiper-slide icon-box icon-box-side text-dark icon-box-chat">
                                <span class="icon-box-icon icon-chat">
                                    <i class="w-icon-chat"></i>
                                </span>
                            <div class="icon-box-content">
                                <h4 class="icon-box-title font-weight-bolder ls-normal">Customer Support</h4>
                                <p class="text-default">Call or email us 24/7</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Iocn Box Wrapper -->

                <div class="category-banner-3cols swiper-container swiper-theme pt-2 mb-10 appear-animate"
                     data-swiper-options="{
                        'spaceBetween': 20,
                        'slidesPerView': 1,
                        'breakpoints': {
                            '576': {
                                'slidesPerView': 2
                            },
                            '992': {
                                'slidesPerView': 3
                            }
                        }
                    }">
                    <div class="swiper-wrapper row cols-lg-3 cols-sm-2 cols-1">
                        <div class="swiper-slide banner banner-fixed br-xs">
                            <figure>
                                <img src="{{ asset('/vendor/wolmart/images/demos/demo7/category/1-1.jpg') }}"
                                     alt="Category Banner" width="440"
                                     height="210" style="background-color: #E3DFDE;"/>
                            </figure>
                            <div class="banner-content y-50">
                                <h3 class="banner-title text-capitalize ls-25">Fashion's</h3>
                                <div class="banner-price-info text-uppercase font-weight-bold text-dark mb-4">
                                    Starting At <span class="text-primary">$29</span>
                                </div>
                                <a href="shop-banner-sidebar.html"
                                   class="btn btn-dark btn-link btn-underline btn-icon-right">
                                    Shop Now<i class="w-icon-long-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- End of Categpry Banner -->
                        <div class="swiper-slide banner banner-fixed br-xs">
                            <figure>
                                <img src="{{ asset('/vendor/wolmart/images/demos/demo7/category/1-2.jpg') }}"
                                     alt="Category Banner" width="440"
                                     height="210" style="background-color: #272729;"/>
                            </figure>
                            <div class="banner-content text-center x-50 y-50 w-100">
                                <h5 class="banner-subtitle text-uppercase font-weight-bold text-primary ls-10">GET 40%
                                    OFF YOUR ENTIRE ORDER!</h5>
                                <h3 class="banner-title text-white text-capitalize">Black Friday Sale</h3>
                                <a href="shop-banner-sidebar.html"
                                   class="btn btn-white btn-outline btn-rounded btn-sm">Shop Now</a>
                            </div>
                        </div>
                        <!-- End of Category Banner -->
                        <div class="swiper-slide banner banner-fixed br-xs">
                            <figure>
                                <img src="{{ asset('/vendor/wolmart/images/demos/demo7/category/1-3.jpg') }}"
                                     alt="Category Banner" width="440"
                                     height="210" style="background-color: #DDD8D5;"/>
                            </figure>
                            <div class="banner-content y-50">
                                <h3 class="banner-title text-capitalize ls-25">For Men's</h3>
                                <div class="banner-price-info text-uppercase font-weight-bold text-dark mb-4">
                                    Starting At <span class="text-primary">$99</span>
                                </div>
                                <a href="shop-banner-sidebar.html"
                                   class="btn btn-dark btn-link btn-underline btn-icon-right">
                                    Shop Now<i class="w-icon-long-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                        <!-- End of Categpry Banner -->
                    </div>
                    <div class="swiper-pagination"></div>
                </div>
                <!-- End of Category Banner 3Cols -->
                <div class="page-content mb-10">
                    <!-- End of Shop Banner -->
                    <div class="container-fluid">
                        <!-- Start of Shop Content -->
                        <div class="shop-content">
                            <!-- Start of Shop Main Content -->
                            @foreach($blocks as $block)
                                <div class="main-content">
                                    <h3>{{ $block->name }}</h3>
                                        <div class="product-wrapper row cols-xl-6 cols-lg-5 cols-md-4 cols-sm-3 cols-2">
                                            @foreach($block->products as $key => $product)
                                                @if($product->users()->exists())
                                                    <div class="product-wrap">
                                                <div class="product text-center">

                                                    <figure class="product-media">

                                                        <a href="{{ route('product.show', $product->slug) }}">

{{--                                                            @foreach($product->images->first()->thumbs as $size)--}}
{{--                                                                @if($size->size == '180')--}}
                                                                    <img src="{{$product->images->first() ? asset($product->images->first()->getPath()) : asset('app/img/no-image.jpg') }}"
                                                                         alt="Product" width="300"
                                                                         height="338"/>
{{--                                                                @endif--}}
{{--                                                            @endforeach--}}
                                                        </a>
                                                    </figure>
                                                    <div class="product-details">
                                                        <div class="product-cat">
                                                            <a href="shop-banner-sidebar.html">{{ $product->category->name }}</a>
                                                        </div>
                                                        <h3 class="product-name">
                                                            <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
                                                        </h3>
                                                        <div class="product-pa-wrapper">
                                                            <div class="product-price">
                                                                от {{ $product->getMinPrice() }} сом/месяц
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                                @endif
                                            @endforeach
                                        </div>
                                </div>
                            @endforeach

                        <!-- End of Shop Content -->
                        </div>
                    </div>
                </div>
                <!-- End of Container -->
            </div>
            <!-- End of Page Cotent -->
    </main>
    <!-- end of .main -->

@endsection

