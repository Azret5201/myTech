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
                        <form class="form checkout-form" action="{{ route('check.code') }}" method="post">
                            @csrf
                            <div class="row mb-9">
                                <div class="col-lg-7 pr-lg-4 mb-4">
                                    <h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
                                        Подверждение почты
                                    </h3>
                                    <p>На вашу почту был отправлен 6 значный код. Введите код или можете перейти по ссылке отправленный на почту</p>
                                    <div class="row gutter-sm">
                                        <div class="col-xs-6">
                                            <div class="form-group">
                                                <input type="number" class="form-control form-control-md" id="codeVal" name="code" placeholder="Введите 6 значный код"
                                                       required>

                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <button type="submit" class="btn btn-primary btn-shadow btn-rounded">Подтвердить</button>

                                        </div>
                                        <div class="col-lg-12">
                                            <button id="sendAgain" class="btn btn-sm btn-link btn-secondary btn-simple">Отправить повторно</button>
                                            <p id="whole-timer" class="m-0 ml-2 text-myGray d-none">Вы сможете отправить повторно через 00:<span
                                                    id="seconds_counter">59</span> секунд
                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
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

@push('scripts')

    <script>
        let seconds_counter = $('#seconds_counter');
        let whole_timer = $('#whole-timer');
        $('#sendAgain').click(function () {
            $('#sendAgain').prop('disabled', true);
            $('#info-span-phone-resend').remove();
            let email = '{{ auth()->user()->email }}';
            $.ajax({
                url: '{{ route('send.again') }}',
                method: 'post',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "email": email,
                },
                success: function () {
                        $('#sendAgain').prop('disabled', true);
                        sessionStorage.setItem("timer", "exists");
                        timer();
                        seconds_counter.text('59');
                        whole_timer.removeClass('d-none');
                }
            })
        });

        {{--$('#emailResendBtn').click(function () {--}}
        {{--    $('#info-span-email-resend').remove();--}}
        {{--    $.ajax({--}}
        {{--        url: '{{route('verification.resend')}}',--}}
        {{--        method: 'post',--}}
        {{--        data: {--}}
        {{--            "_token": "{{ csrf_token() }}",--}}
        {{--        },--}}
        {{--        success: function () {--}}
        {{--            $('#emailResendBtn').before('<div id="info-span-email-resend" class="alert alert-success" role="alert">\n' +--}}
        {{--                'На вашу почту был отправлено новой сообщение' +--}}
        {{--                '</div>');--}}
        {{--        }--}}
        {{--    })--}}
        {{--});--}}

        $(document).ready(function () {
            if (sessionStorage.getItem("timer")) {
                seconds_counter.text('59');
                whole_timer.removeClass('d-none');
                $('#sendAgain').prop('disabled', true);
                timer();
            }
        });

        function timer() {
            myTimer = setInterval(myClock, 1000);
            let c = 59;
            let zero = "";

            function myClock() {
                --c;
                if (c < 10) {
                    zero = "0";
                }
                seconds_counter.text(zero + c);
                if (c === 0) {
                    clearInterval(myTimer);
                    $('#sendAgain').prop('disabled', false);
                    sessionStorage.removeItem('timer');
                    whole_timer.addClass('d-none');
                }
            }
        }
    </script>
@endpush
