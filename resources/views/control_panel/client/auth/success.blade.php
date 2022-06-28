@extends('layouts.includes.app')
@section('content')

<!-- Start of Main -->
<main class="main">
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav mb-10 pb-1">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="demo1.html">Home</a></li>
                <li>Contact Us</li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of PageContent -->
    <div class="page-content contact-us">
        <div class="container">
            <section class="contact-section">
                <div class="row gutter-lg pb-3">
                    <div class="col-lg-12 mb-8">
                        <h4 class="title mb-3"></h4>
                        <div class="order-success text-center font-weight-bolder text-dark">
                            <i class="fas fa-check"></i>
                            Вы успешно прошли регистрацию.
                            <p style="padding-top: 10px;">
                                Чтобы продолжить работу перейдти на
                                <a href="{{ route('main') }}">главную страницу</a> или в
                                <a href="">профиль</a>
                            </p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- End of Contact Section -->
        </div>
    </div>
    <!-- End of PageContent -->
</main>
<!-- End of Main -->

@endsection
