@extends('layouts.control_panel.master')

@section('content')
    <div class="container-xl">
        <!-- Page title -->
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Редактирование продукта</h3>
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item ms-auto">
                        <a class="nav-link" href="{{ route('cp.admin.product') }}">
                            {!! \App\Enum\Icons::BACK() !!}Назад
                        </a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <form action="{{ route('cp.admin.product.update', $product->id) }}" method="post" class="ajax row">
                    <div class="col-md-6">

                        <fieldset>
                            <legend>Информация о продукте</legend>
                            <div class="mb-3">
                                <label class="form-label">Название *</label>
                                <input type="text" class="form-control" name="name" id="name"
                                       placeholder="Пример: Бытовая техника" value="{{ $product->name }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Артикул *</label>
                                <input type="text" class="form-control" name="vendor_code" id="vendor_code"
                                       placeholder="Пример: 100 045 646" value="{{ $product->vendor_code ?? '' }}">
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label for="">Категория</label>
                                <select class="form-control" name="category_id" id="category_id">
                                    @foreach($categories as $categoryAsOption)
                                        <option
                                            value="{{ $categoryAsOption->id }}"{{ $product->category_id == $categoryAsOption->id ? ' selected' : '' }}>{{ str_repeat('- ', $categoryAsOption->depth) }}{{ $categoryAsOption->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label for="">Бренд</label>
                                <select class="form-control" name="brand_id" id="brand_id">
                                    @foreach($brands as $brand)
                                        <option
                                            value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? ' selected' : '' }}>{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Описание *</label>
                                <div class="col-12 form-control"
                                     id="text_blocks.editor">
                                    @isset($product->description)
                                        {!! $product->description  !!}
                                    @endisset
                                </div>
                                <input type="hidden" name="text" id="text" class="form-control">
                                <div class="invalid-feedback"></div>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-6">
                        <fieldset >
                            <legend>Свойства продукта</legend>
                            <div class="ajax" id="props-form">
                            @isset($productProperties)
                                @foreach($productProperties as $productProperty)
                                    @if(!$productProperty->propName->is_price)
                                        <div class="mb-3 row">
                                        <label class="form-label">@if($productProperty->should_user_fill === 1) Обязательное свойство @else Свойство @endif</label>
                                        <div class="col">
                                            <input class="form-control prop @if($productProperty->should_user_fill == 1) bg-azure-lt @endif" name="prop[{{$loop->index}}][propName]"
                                                   list="datalistOptions" placeholder="Свойство"
                                                   value="{{ $productProperty->propName->name }}"/>
                                            <input type="hidden" name="prop[{{$loop->index}}][productProp_id]"
                                                   value="{{ $productProperty->id }}">
                                            <datalist id="datalistOptions">
                                                @foreach($properties as $property)
                                                    <option value="{{ $property->name }}"></option>
                                                @endforeach
                                            </datalist>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                        <div class="col">
                                            <input class="form-control @if($productProperty->should_user_fill == 1) bg-azure-lt @endif" name="prop[{{$loop->index}}][propVal]"
                                                   placeholder="Значение"
                                                   value="{{ $productProperty->value }}"/>
                                            <div class="invalid-feedback"></div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            @endisset
                            </div>
                            <div class="mb-3" id="link-property">
                                <a type="button" id="addProperty" class="text-blue">Добавить свойство</a>
                            </div>
                        </fieldset>
                        <fieldset class="row">
                            <legend>Свойства для продавца</legend>
                            <div class="form-group mb-3">
                                <label for="select2Multiple">Выберите свойства, которые должен указать клиент</label>
                                <select class="select2-multiple form-control" name="shouldUser[]" multiple="multiple"
                                        id="select2Multiple">
                                    @foreach($properties as $property)
                                        <option value="{{ $property->name }}"
                                            @isset($productProperties)
                                                @foreach($productProperties as $productProperty)
                                                    @if($productProperty->propName->name == $property->name && $productProperty->should_user_fill == 1 && !$property->is_price)
                                                        selected
                                                    @endif
                                                @endforeach
                                            @endisset
                                        >{{ $property->name }}</option>>
                                    @endforeach
                                </select>
                            </div>
                        </fieldset>
                    </div>
                    <div class="col-md-12">
                        <fieldset class="form-group">
                            <legend>Изображения</legend>
                            <a href="javascript:void(0)" onclick="$('#pro_image').click()">Загрузить изображения</a>
                            <div class="ajax" id="image-uploader">
                                <input accept="image/*" type="file" id="pro_image" name="pro_imag[]"
                                       style="display: none;" multiple>
                            </div>
                            <div class="preview-images-zone form-control ajax" id="pro_images">
                                @isset($images)
                                    @foreach($images as $image)
                                        <div class="preview-image preview-show-{{ $loop->index }}"
                                             data-id="{{ $loop->index }}">
                                            <div class="image-cancel ajax" id="image-cancel"
                                                 data-no="{{ $loop->index }}">X
                                            </div>
                                            <input type="hidden" id="pro_image_{{ $loop->index }}" class="image_id"
                                                   name="image_id[{{ $loop->index }}][id]" style="display: none;"
                                                   value="{{ $image->id }}">
                                            <input type="hidden" class="order" id="order_{{ $loop->index }}"
                                                   name="image_id[{{ $loop->index }}][order]"
                                                   value="{{ $image->params->order }}">
                                            <div class="image-zone">
                                                <img class="pro-img" id="pro-img-{{ $loop->index }}"
                                                     src="{{ asset(\App\Services\File\Enum\Disk::PRODUCT_PATH()->getValue() . $image->original_name) }}">
                                            </div>
                                            <div class="tools-edit-image">
                                                <a href="#" onclick="openImage({{ $loop->index }});return false;"
                                                   class="btn btn-light btn-open-image">Открыть</a>
                                            </div>
                                        </div>
                                    @endforeach
                                @endisset
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
        $(document).ready(function () {
            let deletedImage = $('#deleted_images').val();
            document.getElementById('pro_image').addEventListener('change', readImage, false);
            $(".preview-images-zone").sortable({
                stop: function (event, ui) {
                    let i = 0;
                    event.target.querySelectorAll('.preview-image').forEach(function (item) {
                        $(item).find('.order').val(i);
                        i++;
                    })
                    let form = event.target.closest('div#pro_images');
                    if (form.classList.contains('ajax')) {
                        let formData = new FormData();
                        let data = [];

                        $('input[name^="image_id"]').each(function (index, el) {
                            if (index % 2 === 0) {
                                data.push({'id': $(el).val()});
                            }
                        });
                        data = JSON.stringify(data);
                        formData.append('image_id', data);
                        let method = 'post';
                        let url = '{{ route('cp.admin.product.image.sort') }}';
                        app.functions.resetValidationState(form);
                        app.functions.ajaxRequest(url, method, formData, form)
                    }
                },
            });

            $(document).on('click', '.image-cancel', function () {
                let no = $(this).data('no');
                deletedImage = $(".preview-image.preview-show-" + no).find('#pro_image_' + no).val()
                let formData = new FormData();
                Swal.fire({
                    title: 'удалить изображение?',
                    html: ``,
                    icon: "warning",
                    confirmButtonText: 'удалить',
                    denyButtonText: 'не удалять',
                    showDenyButton: true,
                    buttons: true,
                })
                    .then((result) => {
                        if (result.isConfirmed) {
                            if (no !== null){
                                let form = this;
                                if (form.classList.contains('ajax')) {
                                    event.preventDefault();
                                    let data = [];
                                    $('input[name^="image_id"]').each(function (index, el) {
                                        if (index % 2 === 0) {
                                            data.push({'id': $(el).val()});
                                        }
                                    });
                                    data = JSON.stringify(data);
                                    formData.append('image_id', data);
                                    formData.append('deleted_id', deletedImage);
                                    formData.append('num', no);
                                    let method = 'post';
                                    let url = '{{ route('cp.admin.product.image.delete') }}';
                                    app.functions.resetValidationState(form);
                                    app.functions.ajaxRequest(url, method, formData, form)
                                }
                            }
                        }

                    })
            });

            $('.select2-multiple').select2({
                placeholder: "Выбрать свойства обязательные для продавца",
                allowClear: true
            });
        });

        $('#addProperty').click(function () {
            let index = $('.prop').length;
            $('#props-form').append('<div class="mb-3 row"><label class="form-label">Свойство</label><div class="col"><input class="form-control prop" name="prop[' + index + '][propName]" id="prop_name" list="datalistOptions" placeholder="Свойство"/><div class="invalid-feedback"></div><datalist id="datalistOptions">@foreach($properties as $property)<option value="{{ $property->name }}"></option> @endforeach </datalist></div><div class="col"><input class="form-control" name="prop[' + index + '][propVal]" placeholder="Значение"/><div class="invalid-feedback"></div></div><div class="mb-3"></div></div>')
        });

        if ($('div#props-form').length > 0) {
            let props = document.getElementById('props-form');
            props.addEventListener('focusout', function (e) {
                let index = document.getElementsByClassName('prop').length - 1;
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
        let num = $('.preview-images-zone').find('.preview-image').length;
        let fileList = new DataTransfer();

        function readImage() {
            if (window.File && window.FileList && window.FileReader) {
                let files = event.target.files;
                if ($(event.target).is('#pro_image')) {
                    for (let i = 0; i < files.length; i++) {
                        let file = files[i];
                        if (!file.type.match('image')) continue;
                        let count = $('.preview-images-zone').find('.preview-image').length + i;

                        let form = event.target.closest('div#image-uploader');
                        if (form.classList.contains('ajax') && file) {
                            event.preventDefault();
                            let formData = new FormData();
                            formData.append('pro_images', file);
                            formData.append('product_id', {{ $product->id }});
                            formData.append('order', num);
                            formData.append('count', count);
                            let method = 'post';
                            let url = '{{ route('cp.admin.product.image.store') }}';
                            app.functions.resetValidationState(form);
                            app.functions.ajaxRequest(url, method, formData, form)
                        }
                        num = num + 1;
                    }
                }
                $('#pro_image').val('');
            } else {
                console.log('Browser not support');
            }

            function openImage(img) {
                let base64URL = $('#pro-img-' + img + '').attr('src');
                let win = window.open();
                win.document.write('<iframe src="' + base64URL + '" frameborder="0" style="border:0; top:0px; left:0px; bottom:0px; right:0px; width:100%; height:100%;" allowfullscreen></iframe>');
            }
        }
    </script>
@endpush
@push('styles')
    <style>
        .preview-images-zone {
            width: 100%;
            border: 1px solid #ddd;
            min-height: 180px;
            padding: 5px 5px 0px 5px;
            position: relative;
            overflow: auto;
        }

        .preview-images-zone > .preview-image:first-child {
            height: 185px;
            width: 185px;
            position: relative;
            margin-right: 5px;
        }

        .preview-image {
            height: 90px;
            width: 90px;
            position: relative;
            margin-right: 5px;
            float: left;
            margin-bottom: 5px;
        }

        .preview-image > .image-zone {
            width: 100%;
            height: 100%;
        }

        .preview-image > .image-zone > img {
            width: 100%;
            height: 100%;
        }

        .preview-image > .tools-edit-image {
            position: absolute;
            z-index: 100;
            color: #fff;
            bottom: 0;
            width: 100%;
            display: none;
            text-align: center;
        }

        .preview-image > .image-cancel {
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

    </style>
@endpush
