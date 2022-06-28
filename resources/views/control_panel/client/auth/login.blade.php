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
                    <div class="col-lg-6 mb-8">
                        <h4 class="title mb-3">People usually ask these</h4>
                        <div class="accordion accordion-bg accordion-gutter-md accordion-border">
                            <div class="card">
                                <div class="card-header">
                                    <a href="#collapse1" class="collapse">How can I cancel my order?</a>
                                </div>
                                <div id="collapse1" class="card-body expanded">
                                    <p class="mb-0">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp orincid
                                        idunt ut labore et dolore magna aliqua. Venenatis tellus in metus vulp utate eu sceler
                                        isque felis. Vel pretium.
                                    </p>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <a href="#collapse2" class="expand">Why is my registration delayed?</a>
                                </div>
                                <div id="collapse2" class="card-body collapsed">
                                    <p class="mb-0">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp orincid
                                        idunt ut labore et dolore magna aliqua. Venenatis tellus in metus vulp utate eu sceler
                                        isque felis. Vel pretium.
                                    </p>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <a href="#collapse3" class="expand">What do I need to buy products?</a>
                                </div>
                                <div id="collapse3" class="card-body collapsed">
                                    <p class="mb-0">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp orincid
                                        idunt ut labore et dolore magna aliqua. Venenatis tellus in metus vulp utate eu sceler
                                        isque felis. Vel pretium.
                                    </p>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <a href="#collapse4" class="expand">How can I track an order?</a>
                                </div>
                                <div id="collapse4" class="card-body collapsed">
                                    <p class="mb-0">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod temp orincid
                                        idunt ut labore et dolore magna aliqua. Venenatis tellus in metus vulp utate eu sceler
                                        isque felis. Vel pretium.
                                    </p>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <a href="#collapse5" class="expand">How can I get money back?</a>
                                </div>
                                <div id="collapse5" class="card-body collapsed">
                                    <p class="mb-0">
                                        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                        temp orincid idunt ut labore et dolore magna aliqua. Venenatis tellus in
                                        metus vulp utate eu sceler isque felis. Vel pretium.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-8">
                        <h4 class="title mb-3">Войти</h4>
                        <form class="form contact-us-form" action="{{ route('login.custom') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="email_1">Email</label>
                                <input type="email" id="email_1" name="email"
                                       class="form-control @error('email') is-invalid @enderror">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="password">Пароль</label>
                                <input type="password" id="password" name="password"
                                       class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary btn-rounded">Войти</button>

                            <a href="{{ route('cp.client.auth.register.get') }}" style="padding-left: 20px;">Регистрация</a>
                        </form>
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
