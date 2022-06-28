<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title></title>
    <!-- CSS files -->
    <link href="/vendor/tabler/css/tabler.min.css" rel="stylesheet"/>
    <link href="/vendor/tabler/css/tabler-vendors.min.css" rel="stylesheet"/>
    <link href="/vendor/quill-js/quill.snow.css" rel="stylesheet">
    <link href="/app/css/style.css" rel="stylesheet"/>
    <!-- CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @stack('styles')
    <style>
        #main_image {
            max-height: 400px;
        }

        .modal-preview-image {
            width: 100px;
        }

        .modal-preview-image > .image-zone {
            height: 90px;
            width: 90px;
            position: relative;
            margin-right: 5px;
            float: left;
            margin-bottom: 5px;
        }

        .modal-preview-image > .image-zone > img {
            width: 100%;
            height: 100%;
        }

        .default_icon > svg{
            max-height: 200px;
            max-width: 200px;
            width: 100%;
            height: 100%;
        }
        .preview-images-zone {
            width: 100%;
            border: 1px solid #ddd;
            min-height: 180px;
            /* display: flex; */
            padding: 5px 5px 0px 5px;
            position: relative;
            overflow:auto;
        }

    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="antialiased">
<div class="page">
    <header class="navbar navbar-expand-md navbar-light d-print-none">
        <div class="container-xl">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <h1 class="navbar-brand navbar-brand-autodark d-none-navbar-horizontal pe-0 pe-md-3">

            </h1>
            <div class="navbar-nav flex-row order-md-last">

                <div class="nav-item dropdown">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown"
                       aria-label="Open user menu">
                        <span class="avatar avatar-sm"
                              style="background-image: url(/vendor/tabler/static/avatars/000m.jpg)"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div>Paweł Kuna</div>
                            <div class="mt-1 small text-muted">UI Designer</div>
                        </div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <a href="#" class="dropdown-item">Set status</a>
                        <a href="#" class="dropdown-item">Profile & account</a>
                        <a href="#" class="dropdown-item">Feedback</a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">Settings</a>
                        <a href="#" class="dropdown-item">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="navbar-expand-md">
        {!! $navbar_view !!}
    </div>
    <div class="content">
        @yield('content')
        <div class="modal modal-blur fade" id="modal-full-width" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-full-width modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Выберите картинку</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <a href="javascript:void(0)" onclick="$('#lib_images').click()">Загрузить изображения</a>
                        <input accept="image/*" type="file" id="lib_images" name="lib_images[]"
                               style="display: none;" multiple>
                        <div class="images row justify-content-between">
                            <fieldset class="form-group h-100 col-md-6">
                                <legend>Изображения</legend>
                                <div class="image-library  row" id="image-library"></div>
                            </fieldset>
                            <div class="main-image col-md-6" id="image">
                                <fieldset class="form-group">
                                    <legend>Изображения</legend>
                                    <div class="default_value text-center">
                                    <span class="default_icon" style="height: 400px">
                                        {!!  \App\Enum\Icons::PICTURE_OFF()  !!}
                                    </span>
                                        <h2 class="default_text font-size-lg">Выберите изображение</h2>
                                    </div>
                                    <img src="" id="main_image">
                                    <div class="mb-3 image-alt" style="display: none">
                                        <label class="form-label">Выберите альтернативное название изображения</label>
                                        <input type="text" class="form-control" name="image_alt" id="image_alt"
                                               placeholder="Пример: Бытовая техника" value="">
                                        <div class="invalid-feedback"></div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn me-auto" data-bs-dismiss="modal">Отменить</button>
                        <button type="button" id="selectImage" onclick="selectImage()" class="btn btn-primary"
                                data-bs-dismiss="modal">Сохранить
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <footer class="footer footer-transparent d-print-none">
            <div class="container">
                <div class="row text-center align-items-center flex-row-reverse">
                    <div class="col-lg-auto ms-lg-auto">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item"><a href="./docs/index.html" class="link-secondary">Documentation</a>
                            </li>
                            <li class="list-inline-item"><a href="./license.html" class="link-secondary">License</a>
                            </li>
                            <li class="list-inline-item"><a href="https://github.com/tabler/tabler" target="_blank"
                                                            class="link-secondary" rel="noopener">Source code</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                        <ul class="list-inline list-inline-dots mb-0">
                            <li class="list-inline-item">
                                Copyright &copy; 2021
                                <a href="." class="link-secondary">Tabler</a>.
                                All rights reserved.
                            </li>
                            <li class="list-inline-item">
                                <a href="./changelog.html" class="link-secondary" rel="noopener">v1.0.0-alpha.22</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<!-- Libs JS -->
<script src="/vendor/tabler/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- Tabler Core -->
<script src="/vendor/tabler/js/tabler.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
{{--<script src="/vendor/tabler/libs/jquery/dist/jquery.slim.min.js"></script>--}}
<script src="/app/lib/axios/js/axios.min.js"></script>
<script src="/vendor/quill-js/quill.js"></script>
<script src="/app/js/core.js"></script>
<script>
    let editorUrl = "{{ route('cp.admin.editor-image') }}";
    let editorDeleteUrl = "{{ route('cp.admin.editor-image.delete') }}";
    let editorStoreUrl = "{{ route('cp.admin.editor-image.store') }}";
</script>
<script src="/app/js/scripts.js"></script>
<!-- CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

@stack('scripts')
</body>
</html>
