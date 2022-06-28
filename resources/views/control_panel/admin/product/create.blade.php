@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Создание продуктов</h3>
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="{{ route('cp.admin.product') }}">
                            {!! \App\Enum\Icons::BACK() !!}Назад
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <form action="{{ route('cp.admin.product.store') }}" method="post" class="ajax row">
                    <div class="col-md-6">
                        <fieldset>
                            <legend>Продукты</legend>
                            <div class="mb-3">
                                <label class="form-label">Название *</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       placeholder="Пример: Бытовая техника">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Артикул *</label>
                                <input type="text" class="form-control" name="vendor_code" id="vendor_code"
                                       placeholder="Пример: 100 045 646">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label for="">Категория</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    @foreach($categories as $categoryAsOption)
                                        <option value="{{ $categoryAsOption->id }}">{{ str_repeat('- ', $categoryAsOption->depth) }}{{ $categoryAsOption->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label for="brand_id">Бренд</label>
                                <select class="form-control" name="brand_id" id="brand_id">
                                    @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Описание *</label>
                                <div class="col-12 form-control"
                                     id="text_blocks.editor">
                                </div>
                                <input type="hidden" name="text" id="text"
                                       class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset class="row">
                            <legend>Свойства для продукта</legend>
                            <div class="ajax" id="props-form">
                            </div>
                            <div class="mb-3" id="link-property">
                                <a type="button" id="addProperty" class="text-blue">Добавить свойство</a>
                            </div>
                        </fieldset>
                        <fieldset class="row">
                            <legend>Свойство для продавца</legend>
                            <div class="form-group mb-3">
                                <label for="select2Multiple">Выберите свойства, которые должен указать клиент</label>
                                <select class="select2-multiple form-control" name="shouldUser[]" multiple="multiple" id="select2Multiple">
                                    @foreach($properties as $property)
                                        @if(!$property->is_price)
                                            <option value="{{ $property->name }}">{{ $property->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-12">
                        <fieldset class="form-group">
                            <legend>Изображения</legend>
                            <a href="javascript:void(0)" onclick="$('#pro_image').click()">Загрузить изображения</a>
                            <input accept="image/*" type="file" id="pro_image" name="pro_imag[]" style="display: none;"
                                   multiple>
                            <div class="preview-images-zone form-control" id="pro_images">
                            </div>
                            <div class="invalid-feedback"></div>
                        </fieldset>
                    </div>
                    <div>
                        <button id="handle-click" class="btn btn-success" type="submit">Сохранить</button>
                    </div>
                </form>
            </div>
        </div>
        <!-- Content here -->
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script>
        $(document).ready(function() {
            $('.select2-multiple').select2({
                placeholder: "Выбрать свойства обязательные для продавца",
                allowClear: true
            });
        });

        $('#addProperty').click(function () {
            let index = $('.prop').length;
            $('#props-form').append('<div class="mb-3 row"><label class="form-label">Свойство</label><div class="col"><input class="form-control prop" name="prop[' + index + '][propName]" id="prop_name" list="datalistOptions" placeholder="Свойство"/><div class="invalid-feedback"></div><datalist id="datalistOptions">@foreach($properties as $property)@if(!$property->is_price)<option value="{{ $property->name }}"></option> @endif @endforeach</datalist></div><div class="col"><input class="form-control" name="prop[' + index + '][propVal]" placeholder="Значение"/><div class="invalid-feedback"></div></div><div class="mb-3"></div></div>')
        });

        if($('div#props-form').length > 0){
            let props = document.getElementById('props-form');
            props.addEventListener('focusout',function (e) {
                let index = document.getElementsByClassName('prop').length -1;
                let propElementVal = document.getElementsByClassName('prop')[index].value;
                let form = e.target.closest('div#props-form');
                if (form.classList.contains('ajax') && propElementVal) {
                    e.preventDefault();
                    let formData = new FormData();
                    formData.append('prop', propElementVal);
                    let method = 'post';
                    let url = '{{ route('cp.admin.product.property.store') }}';
                    app.functions.resetValidationState(form);
                    app.functions.ajaxRequest(url, method, formData, form)
                }
            });
        }

        document.getElementById('pro_image').addEventListener('change', readImage, false);
        $(".preview-images-zone").sortable({
            stop: function (event, ui) {
                let i = 0
                event.target.querySelectorAll('.preview-image').forEach(function (item) {
                    $(item).find('.order').val(i);
                    i++;
                })
            }
        });

        $(document).on('click', '.image-cancel', function () {
            let no = $(this).data('no');
            $(".preview-image.preview-show-" + no).remove();
        });

        let num = 0;
        let fileList = new DataTransfer();

        function readImage() {
            if (window.File && window.FileList && window.FileReader) {
                let files = event.target.files;
                let output = $(".preview-images-zone");
                for (let i = 0; i < files.length; i++) {
                    let file = files[i];
                    if (!file.type.match('image')) continue;
                    let picReader = new FileReader();
                    picReader.addEventListener('load', function (event) {
                        let picFile = event.target;
                        let html =  '<div class="preview-image preview-show-' + num + '" data-id="' + num + '">' +
                            '<div class="image-cancel" data-no="' + num + '">x</div>' +
                            '<input accept="image/*" type="file" id="pro_image_' + num + '" name="pro_images[]" style="display: none;">'+
                            '<input type="hidden" class="order" id="order_'+ num +'" name="order[]" value="'+ num +'">'+
                            '<div class="image-zone"><img class="pro-img" id="pro-img-' + num + '" src="' + picFile.result + '"></div>' +
                            '<div class="tools-edit-image"><a href="#" onclick="openImage(' + num + ');return false;" class="btn btn-light btn-open-image">Открыть</a></div>' +
                            '</div>';
                        output.append(html);
                        let transferData = new DataTransfer();
                        transferData.items.add(file);
                        let input = document.getElementById('pro_image_'+ num);
                        input.files = transferData.files;
                        num = num + 1;
                    });
                    picReader.readAsDataURL(file);
                }
                $('#pro_image').val('');
            } else {
                console.log('Browser not support');
            }
        }

        function openImage(img) {
            let base64URL = $('#pro-img-' + img + '').attr('src');
            var win = window.open();
            win.document.write('<iframe src="' + base64URL  + '" frameborder="0" style="border:0; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%;" allowfullscreen></iframe>');
        }
    </script>
@endpush
@push('styles')
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
        .preview-images-zone > .preview-image:first-child {
            height: 185px;
            width: 185px;
            position: relative;
            margin-right: 5px;
        }
        .preview-images-zone > .preview-image {
            height: 90px;
            width: 90px;
            position: relative;
            margin-right: 5px;
            float: left;
            margin-bottom: 5px;
        }
        .preview-images-zone > .preview-image > .image-zone {
            width: 100%;
            height: 100%;
        }
        .preview-images-zone > .preview-image > .image-zone > img {
            width: 100%;
            height: 100%;
        }
        .preview-images-zone > .preview-image > .tools-edit-image {
            position: absolute;
            z-index: 100;
            color: #fff;
            bottom: 0;
            width: 100%;
            text-align: center;
            margin-bottom: 10px;
            display: none;
        }
        .preview-images-zone > .preview-image > .image-cancel {
            font-size: 18px;
            position: absolute;
            top: 0;
            right: 0;
            font-weight: bold;
            margin-right: 10px;
            cursor: pointer;
            display: none;
            z-index: 100;
        }
        .preview-image:hover > .image-zone {
            cursor: move;
            opacity: .5;
        }
        .preview-image:hover > .tools-edit-image,
        .preview-image:hover > .image-cancel {
            display: block;
        }
        .ui-sortable-helper {
            width: 90px !important;
            height: 90px !important;
        }

        .container {
            padding-top: 50px;
        }
    </style>
@endpush
