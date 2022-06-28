let editor = document.getElementById('text_blocks.editor')
document.getElementById('lib_images').addEventListener('change', modalReadImage, false);
var Delta = Quill.import('delta');
if (editor !== null) {
    const quill = new Quill(editor, {
        modules: {
            toolbar: {
                container: app.data.quillToolbar,
                handlers: {
                    'image': function (value) {
                        let ranges = quill.getSelection();
                        const range = ranges ? ranges.index : 0;
                        localStorage.setItem('range', range)
                        $('#modal-full-width').modal('toggle');
                        if ($("#image-library").is(':empty')) {
                            let method = 'post';
                            let url = editorUrl;
                            app.functions.ajaxRequest(url, method);
                        }
                    }
                }
            },
            clipboard: {
                matchVisual: false
            },
        },
        placeholder: 'Введите текст',
        theme: 'snow'
    });
    let form = document.querySelector('form');
    form.onsubmit = function () {
        const editor = document.querySelector('input[id="text"]');
        editor.value = quill.root.innerHTML.replace('<p><br></p>', '');
        if (editor.value === '') {
            let errors = {'text': ['Поле обязательно к заполнению']}
            app.functions.handleValidationErrors(form, errors)
            return false;
        }
        return true;
    };

    function insertToEditor(url) {
        $('#modal-full-width').modal('toggle');
        let range = localStorage.getItem('range')
        localStorage.removeItem('range')
        quill.insertEmbed(range ?? 0, 'image', `${url}`);
    }

    function selectMainImageInModal(url) {
        $('.default_value').hide();
        $('.image-alt').show();
        $('#main_image').attr('src', url)
    }

    function selectImage() {
        let range = localStorage.getItem('range')
        localStorage.removeItem('range')
        let url = $('#main_image').attr('src');
        let imageAlt = $('#image_alt');
        quill.updateContents(
            new Delta()
                .retain(range)
                .insert(
                    {
                        image: url
                    },
                    {
                        width: '800',
                        alt: imageAlt.val(),
                    }
                ));
        imageAlt.val('');
    }
}
$(document).on('click', '.modal-image-cancel', function () {
    let no = $(this).data('no');
    let formData = new FormData();
    Swal.fire({
        title: 'удалить изображение из библиотки?',
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
                        let parentImage = $(this).closest('.modal-preview-image')[0];
                        formData.append('data_id', parentImage.getAttribute('data-id'))
                        formData.append('image_id', $(parentImage).find('#image_id').val());
                        let method = 'post';
                        let url = editorDeleteUrl;
                        app.functions.ajaxRequest(url, method, formData)
                }
            }

        })
});
function modalReadImage() {
    if (window.File && window.FileList && window.FileReader) {
        let files = event.target.files;
        if ($(event.target).is('#lib_images')) {
            for (let i = 0; i < files.length; i++) {
                let file = files[i];
                if (!file.type.match('image')) continue;
                event.preventDefault();
                let formData = new FormData();
                formData.append('lib_images', file);
                let method = 'post';
                let url = editorStoreUrl;
                app.functions.ajaxRequest(url, method, formData,)
            }
        }
        $('#lib_images').val('');
    } else {
        console.log('Browser not support');
    }
}
