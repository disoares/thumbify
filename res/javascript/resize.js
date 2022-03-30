$(document).ready(function () {

    const dropArea = document.getElementById('area-drag-and-drop');
    dropArea.addEventListener('dragenter', handleDragEnter, false);
    dropArea.addEventListener('dragover', handlerDragOver, false);
    dropArea.addEventListener('drop', handlerDrop, false);

    function handleDragEnter(e) {
        e.stopPropagation();
        e.preventDefault();
    }

    function handlerDragOver(e) {
        e.stopPropagation();
        e.preventDefault();
    }

    function handlerDrop(e) {
        e.stopPropagation();
        e.preventDefault();
        var dt = e.dataTransfer;
        var files = dt.files;

        // Add to input file
        document.getElementById('image-to-thumbify').files = files;

        updateImage();

    }

    $('#image-to-thumbify').on('change', () => {
        updateImage();
    });

    const updateImage = () => {

        const form_data = new FormData($("form[name='form-image-to-thumbify']")[0]);

        $.ajax({
            xhr: function () {
                let xhr = new window.XMLHttpRequest();
                xhr.upload.addEventListener("progress", function (evt) {
                    if (evt.lengthComputable) {
                        let percentComplete = (evt.loaded / evt.total) * 100;
                        document.getElementsByClassName('perc-loading')[0].innerText = Math.floor(percentComplete) + '%';
                    }
                }, false);
                return xhr;
            },
            url: "/upload",
            type: "post",
            dataType: "json",
            contentType: false,
            processData: false,
            data: form_data,
            beforeSend: () => {
                $('.help-block').html('');
                document.getElementById('area-drag-and-drop').innerHTML = loading();
            },
            success: (response) => {
                if (response.status === 'success') {                    

                    let img = document.getElementById('img-to-thumbify');
                    img.title = response.name;
                    img.src = `/src/images/temp/${response.name}`;
                    img.style.display = 'block';

                    document.getElementById('area-drag-and-drop').style.display = 'none';

                    $('#btn-submit').prop('disabled', false);

                    $('.area-btn-download').html('');

                } else {
                    document.getElementsByClassName('help-block')[0].innerText = response.message;
                    document.getElementById('area-drag-and-drop').innerHTML = defaultUploadArea();
                }
            },
            error: (err) => {
                console.log(err);
            }
        });

    }

    $('#form-image-to-thumbify').on('submit', () => {

        const form_data = new FormData($("form[name='form-image-to-thumbify']")[0]);

        $.ajax({
            url: "/resize",
            type: "post",
            dataType: "json",
            contentType: false,
            processData: false,
            data: form_data,
            beforeSend: () => {
                $('.help-block').html('');
            },
            success: (response) => {
                if (response.status === 'success') {
                    $('.area-btn-download').html(`<a href="/src/images/temp/${response.filename}" class="btn btn-success" download>Download</a>`);
                }
            },
            error: (err) => {
                console.log(err);
            }
        });

        return false;
    });

    const loading = () => {
        return `
            <div class="spinner-border text-primary" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            <div class="perc-loading"></div>
        `;
    }

    const defaultUploadArea = () => {
        return `
            <div>
                <img src="/res/images/icons/download.svg" alt="ícone upload" />
            </div>
            Ou arraste uma imagem e solte aqui
        `;
    }

});