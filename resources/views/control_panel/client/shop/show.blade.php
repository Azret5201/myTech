@extends('layouts.includes.app')

@section('content')
    <main class="main">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb bb-no">
                    <li><a href="demo1.html">Главная страница</a></li>
                    <li><a href="#">Магазины</a></li>
                    <li><a href="#">{{ $shop->name }}</a></li>
                </ul>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of Pgae Contetn -->
        <div class="page-content mb-8">
            <div class="container">
                <div class="store store-wcfm-banner">
                    <figure class="store-media">
                            <img src="{{ asset('vendor/wolmart/images/vendor/wcfm/1.jpg') }}" alt="Vendor" class="w-100"
                             style="background-color: #40475e;" />
                    </figure>
                    <div class="store-content">
                        <div class="store-content-left mr-auto">
                            <div class="personal-info">
                                <figure class="seller-brand">
{{--                                    <img src="" alt="Brand" width="100"--}}
{{--                                         height="100" />--}}
                                </figure>

                                <div class="ratings-container">
                                    <div class="ratings-full">
                                        <span class="ratings" style="width: 100%;"></span>
                                        <span class="tooltiptext tooltip-top"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="address-info">
                                <h4 class="store-title">{{ $shop->name }}</h4>
                                <ul class="seller-info-list list-style-none">
                                    <li class="store-address">
                                        <i class="w-icon-map-marker"></i>
                                        {{ $shop->address }}
                                    </li>
                                    <li class="store-phone">
                                        @foreach($shop->contacts as $contact)
                                        <a href="tel:123456789">
                                            <i class="w-icon-phone"></i>

                                            {{ $contact }}
                                        </a>
                                        @endforeach
                                    </li>
                                    <li class="store-email">
                                        <a href="email:#">
                                            <i class="far fa-envelope"></i>
                                            wc@vendor.com
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="store-content-right">
{{--                            <div class="btn btn-white btn-rounded btn-icon-left btn-inquiry"><i--}}
{{--                                    class="far fa-question-circle"></i>Inquiry</div>--}}
                            <div class="social-icons social-icons-colored border-thin">
                                <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                <a href="#" class="social-icon social-linkedin fab fa-linkedin"></a>
                                <a href="#" class="social-icon social-youtube w-icon-youtube"></a>
                                <a href="#" class="social-icon social-instagram w-icon-instagram"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Store WCMP Banner -->

                <div class="row gutter-lg">
                    <aside class="sidebar left-sidebar vendor-sidebar sticky-sidebar-wrapper sidebar-fixed">
                        <!-- Start of Sidebar Overlay -->
                        <div class="sidebar-overlay"></div>
                        <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                        <a href="#" class="sidebar-toggle"><i class="w-icon-angle-right"></i></a>
                        <div class="sidebar-content">
                            <div class="sticky-sidebar">
                                <div class="widget widget-collapsible widget-categories">
                                    <h3 class="widget-title"><span>Все категории</span></h3>
                                    <ul class="widget-body filter-items search-ul">
                                        @foreach($categories as $category)
                                            <li>
                                                <a href="javascript:void(0)" class="category-get" data-id="{{ $category->id }}" data-shop="{{ $shop->slug }}">{{ $category->name }}</a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- End of Widget -->

                            </div>
                        </div>
                    </aside>
                    <!-- End of Sidebar -->

                    <div class="main-content">
                        <div class="tab tab-nav-underline tab-nav-boxed tab-vendor-wcfm">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="#tab-1" class="nav-link active">Товары</a>
                                </li>
                                <li class="nav-item">
                                    <a href="#tab-2" class="nav-link">О нас</a>
                                </li>
{{--                                <li class="nav-item">--}}
{{--                                    <a href="#tab-3" class="nav-link">Политика</a>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item">--}}
{{--                                    <a href="#tab-4" class="nav-link">Отзывы(1)</a>--}}
{{--                                </li>--}}
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab-1">
                                    <div class="product-wrapper row cols-md-3 cols-sm-2 cols-2">
                                        @include('control_panel.client.shop.productsList', compact('products'))
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-2">
                                    <p class="mb-4">{!! $shop->description !!}</p>

                                </div>
                                <div class="tab-pane" id="tab-3">
                                    <div class="policies-area">
                                        <h3 class="title">Shipping Policy</h3>
                                        <p><strong>L</strong>orem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod tempor incididunt arcu cursus. Sagittis id consectetur
                                            purus
                                            ut. Tellus rutrum tellus pelle.</p>
                                    </div>
                                    <div class="policies-area">
                                        <h3 class="title">Refund Policy</h3>
                                        <p><strong>L</strong>orem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod tempor incididunt arcu cursus. Sagittis id consectetur
                                            purus ut. Tellus rutrum tellus pelle.</p>
                                    </div>
                                    <div class="policies-area">
                                        <h3 class="title text-left">Cancellation / Return / Exchange Policy</h3>
                                        <p><strong>L</strong>orem ipsum dolor sit amet, consectetur adipiscing elit,
                                            sed do eiusmod tempor incididunt arcu cursus. Sagittis id consectetur
                                            purus ut. Tellus rutrum tellus pelle.</p>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab-4">
                                    <div class="review-area">
                                        <h3 class="title font-weight-bold mb-5">Write A Review</h3>
                                        <input name="review" type="text" class="form-control"
                                               placeholder="your review">
                                        <button class="btn btn-rounded">Add Your Review</button>
                                    </div>
                                    <!-- End of Reveiw Area -->
                                    <div class="review-area">
                                        <h3 class="title font-weight-bold mb-5">Reviews</h3>
                                        <div class="reviewers d-flex align-items-center flex-wrap mb-7">
                                            <div class="reviewers-picture d-flex mr-2">
                                                <figure>
                                                    <img src="assets/images/vendor/wcfm/avatar.png" alt="Avatar"
                                                         width="113" height="112" />
                                                </figure>
                                                <figure>
                                                    <img src="assets/images/vendor/wcfm/avatar.png" alt="Avatar"
                                                         width="113" height="112" />
                                                </figure>
                                                <figure>
                                                    <img src="assets/images/vendor/wcfm/avatar.png" alt="Avatar"
                                                         width="113" height="112" />
                                                </figure>
                                            </div>
                                            <div class="reviewer-name">
                                                <a href="#" class="font-weight-bold mr-1">John Doe</a>has reviewed
                                                this store
                                            </div>
                                        </div>
                                        <!-- End of Reviewers -->
                                        <div class="review-ratings">
                                            <div class="review-ratings-left mr-auto">
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 100%;"></span>
                                                    </div>
                                                    <label>5.0 Feature</label>
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 100%;"></span>
                                                    </div>
                                                    <label>5.0 Varity</label>
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 100%;"></span>
                                                    </div>
                                                    <label>5.0 Flexibility</label>
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 100%;"></span>
                                                    </div>
                                                    <label>5.0 Delivery</label>
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 100%;"></span>
                                                    </div>
                                                    <label>5.0 Support</label>
                                                </div>
                                            </div>
                                            <!-- End of Review Ratings Left -->
                                            <div class="review-ratings-right">
                                                <div class="average-rating">5.0<sub>/5</sub></div>
                                                <div class="ratings-container">
                                                    <div class="ratings-full mr-0">
                                                        <span class="ratings" style="width: 100%;"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End of Review Ratings Right -->
                                        </div>
                                        <!-- End of Review Ratings -->
                                        <div class="user-wrap">
                                            <div class="user-photo">
                                                <figure>
                                                    <img src="assets/images/vendor/wcfm/avatar.png" alt="Avatar"
                                                         width="113" height="112" />
                                                </figure>
                                                <div class="rated text-center">
                                                    <label>Rated</label>
                                                    <span class="score">5.0</span>
                                                </div>
                                            </div>
                                            <!-- End of User Photo -->
                                            <div class="user-info">
                                                <h4 class="user-name">John Doe</h4>
                                                <div class="user-date mb-7">
                                                    <span>1 Reviews</span>
                                                    <span>April 1, 2021 12:12 Pm</span>
                                                </div>
                                                <p>Diam in arcu cursus euismod quis. Eget sit amet tellusvitae
                                                    sapien pellentesque habitant morbi tristique senectus et.
                                                    Cras adipiscing enim ermentum et sollicitudin ac orci phasellus.
                                                </p>
                                            </div>
                                            <!-- End of User Info -->
                                            <div class="review-ratings">
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 100%;"></span>
                                                    </div>
                                                    <label>5.0 Feature</label>
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 100%;"></span>
                                                    </div>
                                                    <label>5.0 Varity</label>
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 100%;"></span>
                                                    </div>
                                                    <label>5.0 Flexibility</label>
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 100%;"></span>
                                                    </div>
                                                    <label>5.0 Delivery</label>
                                                </div>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 100%;"></span>
                                                    </div>
                                                    <label>5.0 Support</label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End of User Wrap -->
                                    </div>
                                    <!-- End of Reveiw Area -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Main Content -->
                </div>
            </div>
        </div>
        <!-- End of Page Content -->
    </main>
@endsection

@push('scripts')
    <script>
        $(document).on('click', '.category-get', function (event) {
            let categoryId = event.currentTarget.getAttribute('data-id');
            let shopSlug = event.currentTarget.getAttribute('data-shop');
            $.ajax({
                url: '{{ route('shop.get.category.products') }}',
                method: 'get',
                data: {
                    id: categoryId,
                    slug: shopSlug
                },
                success: function (data){
                    $('.product-wrapper').html(data.view);
                }
            })
        })
    </script>

@endpush
