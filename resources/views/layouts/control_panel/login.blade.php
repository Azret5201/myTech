
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Авторизация</title>

    <!-- Styles -->
    <link rel="stylesheet" href="/vendor/tabler/css/tabler.min.css">
    <!-- Fonts -->

    @stack('styles')
</head>
<body class="">
<div class="flex-fill d-flex flex-column justify-content-center py-4">
    <div class="container-tight py-6">

        <div class="page">
            <div class="page-single">
                <div class="container">
                    <div class="row">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="/vendor/tabler/libs/jquery/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="/app/lib/axios/js/axios.min.js"></script>
<script src="/app/js/core.js"></script>
</body>

</html>
