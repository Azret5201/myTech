(function () {
    const toast = document.querySelector('meta[name=toast]');

    if (null !== toast){
        Toastify({
            text: toast.attributes.getNamedItem('content').value,
            backgroundColor: '#D6EBFF',
            className: toast.attributes.getNamedItem('data-type').value,
            close: true,
            gravity: "top",
            position: 'right',
            stopOnFocus: true,
        }).showToast();
    }

})();

document.addEventListener('submit', function (e) {

    let form = e.target;
    if (form.classList.contains('ajax')) {
        e.preventDefault();
        let formData = new FormData(form);
        let method = form.getAttribute('method');
        var url = form.getAttribute('action');

        if (e.submitter) {
            if (e.submitter.getAttribute('formaction'))
            {
                url = e.submitter.getAttribute('formaction');
            }
        }

        app.functions.resetValidationState(form);
        app.functions.ajaxRequest(url, method, formData, form)
    }
});

document.addEventListener('submit', function (e) {

    let form = e.target;
    if (form.classList.contains('ajax-new')) {
        e.preventDefault();
        let formData = new FormData(form);
        let method = form.getAttribute('method');
        var url = form.getAttribute('action');

        if (e.submitter) {
            if (e.submitter.getAttribute('formaction'))
            {
                url = e.submitter.getAttribute('formaction');
            }
        }

        app.functions.ajaxRequest(url, method, formData, form)
    }
});

$('.handle-click').click(function (e){
    e.preventDefault();

    let url;
    switch ($(this).data("type")) {

        case 'modal':

            let modal = $(this).data('modal');
            url = $(this).data('url');
            app.functions.loadModalContent(modal, url);
            break;

        case 'ajax-confirm':

            let title = $(this).data('title');
            let content = $(this).data('content');
            let icon = $(this).data('icon');
            let confirmBtnText = $(this).data('confirm-btn-text');
            let denyBtnText = $(this).data('deny-btn-text');
            url = $(this).data('url');
            let method = $(this).data('method');
            app.functions.ajaxConfirm(
                title,
                content,
                icon,
                confirmBtnText,
                denyBtnText,
                url,
                method
            );
            break;
    }

});


$('.handle-click').click(function (e){
    e.preventDefault();

    let url;
    switch ($(this).data("type")) {

        case 'modal':

            let modal = $(this).data('modal');
            url = $(this).data('url');
            app.functions.loadModalContent(modal, url);
            break;

        case 'ajax-confirm':

            let title = $(this).data('title');
            let content = $(this).data('content');
            let icon = $(this).data('icon');
            let confirmBtnText = $(this).data('confirm-btn-text');
            let denyBtnText = $(this).data('deny-btn-text');
            url = $(this).data('url');
            let method = $(this).data('method');
            app.functions.ajaxConfirm(
                title,
                content,
                icon,
                confirmBtnText,
                denyBtnText,
                url,
                method
            );
            break;
    }

});



// document.addEventListener('click', function (e) {
//     handleClick(e);
// });
//
// document.addEventListener('touchstart', function (e) {
//     handleClick(e);
// });

let handleClick = function (e) {
    let element = e.target;
    console.log(element.classList.contains('handle-click'));
    if (element.classList.contains('handle-click')) {

        e.preventDefault();


    }
};



let run = function (functionList) {
    for (let functionItem in functionList) {
        app.functions[functionItem](functionList[functionItem].params);

    }
}

let app = {
    pageBusy: function(){
        if(document.querySelector('.btn.btn-success')){
            document.querySelector('.btn.btn-success').classList.add('disabled');
            document.querySelector('.btn.btn-success').innerHTML = 'Отправка<span class="animated-dots"></span>';
        }
    },

    pageUnBusy: function(){
        if(document.querySelector('.btn.btn-success')){
            document.querySelector('.btn.btn-success').classList.remove('disabled');
            document.querySelector('.btn.btn-success').innerHTML = 'Отправить';
        }
    },
    data: {
        modals: {
            small: 'modalSmall',
            regular: 'modalRegular',
            large: 'modalLarge',
            transactionDetails: 'transactionDetails'
        },
        quillToolbar: [
            [{ 'header': [1, 2, 3, false] }],
            ['bold', 'italic', 'underline', 'link'],
            [{ 'list': 'ordered'}, { 'list': 'bullet' }],
            ['clean'],
            ['image']
        ],

        loader: '<div class="text-center"><div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div></div>',

    },
    functions: {
        ajaxRequest: function (url, method = 'get', formData = null, form = null, returnResponse = false) {
            app.pageBusy();

            axios({
                method: method,
                url: url,
                data: formData,
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            })
                .then(function (response) {

                    app.pageUnBusy();
                    if (true === returnResponse) {
                        return response;
                    }

                    if (response.data.functions) {
                        run(response.data.functions);
                    }

                })
                .catch(function (error) {

                    app.pageUnBusy();
                    if (error.response.status)
                    {
                        switch (error.response && error.response.status) {
                            case 422:
                                app.functions.handleValidationErrors(form, error.response.data.errors)
                                break;

                            case 403:
                            case 400:
                            case 401:
                                if (error.response.data.functions) {
                                    run(error.response.data.functions);
                                }
                                break;
                            case 500:
                                app.functions.alert({
                                    title: 'Ошибка',
                                    message: 'Внутренняя ошибка сервера',
                                    type: 'error'
                                })
                                break;
                        }
                    }

                });
        },

        alert: function (params) {
            Swal.fire(
                params.title,
                params.message,
                params.type
            )
        },

        ajaxConfirm: function (title, content = '', icon, confirmBtnText, denyBtnText, url, method){
            Swal.fire({
                title: title,
                html: `<p class="text-center">` + content + `</p>`,
                icon: icon,
                confirmButtonText: confirmBtnText,
                denyButtonText: denyBtnText,
                showDenyButton: true,
                buttons: true,
            })
                .then((result) => {
                   if (result.isConfirmed) {
                       app.functions.ajaxRequest(url, method);
                   }

                });
        },

        handleValidationErrors: function (form, errors) {
            for (let inputId in errors) {

                let field = document.getElementById(inputId);

                if (field &&  field.parentElement.classList.contains('input-control'))
                {
                    field.parentElement.classList.add('error');
                }

                if (field && field.classList.contains('form-control')) {
                    field.classList.add('is-invalid');

                }

                if (field) {
                    let invalidFeedback = field.nextElementSibling;
                    if (invalidFeedback && invalidFeedback.classList.contains("invalid-feedback")) {

                        invalidFeedback.textContent = errors[inputId];
                    }
                }

            }
        },

        loadModalContent: function (modalType, url) {

            if (modalType in app.data.modals) {

                let modalObject = document.getElementById(app.data.modals[modalType]);


                if (modalObject instanceof HTMLElement) {
                    modalObject.style.display = 'block';
                    url = url + '?response=modal&type=' + modalType;
                    app.functions.ajaxRequest(url);
                }
            }
        },

        updateModalBody: function (params) {
            let modalObject = document.getElementById(app.data.modals[params.type]);
            if (modalObject instanceof HTMLElement) {
                let title = modalObject.getElementsByClassName('modal-title').item(0);
                let body = modalObject.getElementsByClassName('modal-body').item(0);
                title.innerHTML = params.title;
                body.innerHTML = params.content;
            }
        },

        updateContent: function (params) {
            let contentBlock = document.getElementById(params.blockId);

            if (contentBlock) {
                contentBlock.innerHTML = params.content;
            }
        },

        removeElement: function (params) {
            let contentBlock = $(params.parentId).find('[data-id="'+ params.id +'"]');
            if (params.updateChildEl) {
                contentBlock.remove();
                if(params.parentId !== ''){
                    let i = 0;
                    document.querySelectorAll('.preview-image').forEach(function (item) {
                        $(item).attr({'class':'preview-image preview-show-' + i, 'data-id': i});
                        $(item).find('.order').val(i);
                        $(item).find('#image-cancel').attr('data-no', i);
                        $(item).find('.image_id').attr({id: 'pro_image_' + i, name: 'image_id[' + i + '][id]'});
                        $(item).find('.order').attr({id: 'order_' + i, name: 'image_id[' + i + '][order]'});
                        $(item).find('.pro-img').attr('id', 'pro-img-' + i);
                        $(item).find('.btn-open-image').attr({onclick: 'openImage(' + i + ')'});
                        i++;
                    })
                }
            }else{
                contentBlock.remove();
            }
        },

        showElement: function (params) {
            let contentBlock =   document.getElementById(params.id);

            if (contentBlock) {
                contentBlock.style.display = 'block';
            }
        },

        redirect: function (params) {
            window.location = params.url;
        },
        resetValidationState: function (form) {
            let allInputs = form.querySelectorAll(".form-control");
            let allInputs2 = form.querySelectorAll(".input-control");
            let invalidFeedback = form.querySelectorAll(".invalid-feedback");
            allInputs.forEach(function (input) {
                input.classList.remove('is-invalid');
                input.nextSibling.textContent = '';
            });

            allInputs2.forEach(function (input) {
                input.classList.remove('error');
            });

            invalidFeedback.forEach(function (input) {
                input.textContent = '';
            });
        },
        toast: function (params) {
            Toastify({
                text: params.text,
                backgroundColor: params.color,
                className: params.className,
                close: true,
                gravity: "top",
                position: 'right',
                stopOnFocus: true,
            }).showToast();
        },

        initDateInput: function (params) {
            if (0 !== document.getElementsByClassName("date-input").length) {
                new Cleave('.date-input', {
                    date: true,
                    delimiter: '.',
                    datePattern: ['d', 'm', 'Y']
                });
            }
        },

        reload: function (){
            window.location.reload(params);
        },

        addOption: function (params){
            let val = $(params.parentId).find('option[value*="' + params.value + '"]').val();
            if(!val){
                $(params.parentId).append("<option value='" + params.value + "'>" + params.value + "</option>");
            }
        },
        addImage: function (params){
            if(!params.icons) {
                let html = '<div class="preview-image preview-show-' + params.num + '" data-id="' + params.num + '">' +
                    '<div class="image-cancel ajax" id="image-cancel" data-no="' + params.num + '">x</div>' +
                    '<input type="hidden" id="pro_image_' + params.num + '" class="image_id" name="image_id[' + params.num + '][id]" style="display: none;" value="' + params.imageId + '">' +
                    '<input type="hidden" class="order" id="order_' + params.num + '" name="image_id[' + params.num + '][order]" value="' + params.num + '">' +
                    '<div class="image-zone"><img class="pro-img" id="pro-img-' + params.num + '" src="' + params.image + '"></div>' +
                    '<div class="tools-edit-image"><a href="#" onclick="openImage(' + params.num + ');return false;" class="btn btn-light btn-open-image">Открыть</a></div>' +
                    '</div>';
                $(params.parentId).append(html);
            }else{
                let index = $(params.parentId).find('.preview-image').length;
                let html = '<div class="modal-preview-image m-1 p-1 card col-6 col-sm-4 preview-show-' + index + '" data-id="' + index + '">' +
                    '<div class="image-zone"><img class="pro-img" id="pro-img-' + index + '" src="' + params.image + '"></div>' +
                    '<input type="hidden" id="image_id" name="image_id" value="'+ params.imageId +'">'+
                    '<div class="modal-image-tools row"><a href="#" title="Вставить изображение" onclick="insertToEditor(\''+ params.image +'\');return false;" class="col-4 text-success">'+ params.icons['check'] +'</a>' +
                    '<a href="#" title="Добавить альтернативное название" onclick="selectMainImageInModal(\''+ params.image +'\');return false;" class="col-4 text-info">'+ params.icons['edit'] +'</a>' +
                    '<a href="#" title="Удалить из библиотеки изображений" onclick="deleteImage(\''+ params.image +'\');return false;" class="col-4 text-danger modal-image-cancel">'+ params.icons['delete'] +'</a></div>' +
                    '</div>';
                $(params.parentId).append(html);
            }
        },
        createEditorLibrary: function (params){
            params.imageArray.forEach( function (file, index){
                let html = '<div class="modal-preview-image m-1 p-1 card col-6 col-sm-4 preview-show-' + index + '" data-id="' + index + '">' +
                    '<div class="image-zone"><img class="pro-img" id="pro-img-' + index + '" src="' + params.path + '/' + file.original_name + '"></div>' +
                    '<input type="hidden" id="image_id" name="image_id" value="'+ file.id +'">'+
                    '<div class="modal-image-tools row"><a href="#" title="Вставить изображение" onclick="insertToEditor(\''+ params.path + '/' + file.original_name +'\');return false;" class="col-4 text-success">'+ params.icons['check'] +'</a>' +
                    '<a href="#" title="Добавить альтернативное название" onclick="selectMainImageInModal(\''+ params.path + '/' + file.original_name +'\');return false;" class="col-4 text-info">'+ params.icons['edit'] +'</a>' +
                    '<a href="#" title="Удалить из библиотеки изображений" onclick="selectMainImageInModal(\''+ params.path + '/' + file.original_name +'\');return false;" class="col-4 text-danger modal-image-cancel">'+ params.icons['delete'] +'</a></div>' +
                    '</div>';
                $(params.parentId).append(html);
            })
        },
    }
};


$(document).ready(function () {
    if ($('.selectable').length) {

        $('.selectable').selectize({
            plugins: ['remove_button'],
        });
    }

    if ($('.flatpickr-input').length) {
        flatpickr(document.getElementsByClassName('flatpickr-input'), {
            dateFormat: 'd.m.Y'
        });
    }

    if ($('.editor').length) {

        let quill = new Quill('.editor', {
            theme: 'snow',
            height: 200
        });

        quill.on('text-change', function(delta, oldDelta, source) {
                $('#text').val(quill.container.firstChild.innerHTML);
        });
    }

    if ($('.expert_opinion_editor').length) {

        let quillEO = new Quill('.expert_opinion_editor', {
            theme: 'snow',
            height: 200
        });

        quillEO.on('text-change', function(delta, oldDelta, source) {
            $('#expert_opinion_val').val(quillEO.container.firstChild.innerHTML);
        });
    }

    if ($('.risk_assessment_editor').length) {

        let quillEO = new Quill('.risk_assessment_editor', {
            theme: 'snow',
            height: 200
        });

        quillEO.on('text-change', function(delta, oldDelta, source) {
            $('#risk_assessment_val').val(quillEO.container.firstChild.innerHTML);
        });
    }

    if ($('.loan_security_editor').length) {

        let quillEO = new Quill('.loan_security_editor', {
            theme: 'snow',
            height: 200
        });

        quillEO.on('text-change', function(delta, oldDelta, source) {
            $('#loan_security_val').val(quillEO.container.firstChild.innerHTML);
        });
    }

});
