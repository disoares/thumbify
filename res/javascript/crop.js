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
            url: "/upload",
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

                    let img = document.getElementById('img-to-thumbify');
                    img.title = response.name;
                    img.src = `/src/images/temp/${response.name}`;
                    img.style.display = 'block';

                    document.getElementById('area-drag-and-drop').style.display = 'none';

                    $('#btn-submit').prop('disabled', false);

                    $('.area-btn-download').html('');

                    makeCroppable();

                } else {
                    $('#btn-add-image').siblings('.help-block').css('display', 'block');
                    $('#btn-add-image').siblings('.help-block').html(response.message);
                }
            },
            error: (err) => {
                console.log(err);
            }
        });
    }

    const makeCroppable = () => {
        $('#img-to-thumbify').cropper();
    }

    $('#form-image-to-thumbify').on('submit', () => {

        $('#img-to-thumbify').cropper('getCroppedCanvas', {
            width: 1000,
            minWidth: 256,
            maxWidth: 4096,
            maxHeight: 4096,
            fillColor: '#fff',
            imageSmoothingEnabled: false,
            imageSmoothingQuality: 'high',            
        }).toBlob((blob) => {

            const formData = new FormData($("form[name='form-image-to-thumbify']")[0]);
            formData.append('imageToCropped', blob);

            $.ajax({
                url: "/resize",
                type: "post",
                dataType: "json",
                contentType: false,
                processData: false,
                data: formData,
                beforeSend: () => {
                    $('.help-block').html('');
                    $('#img-preview').attr('src', '');
                },
                success: (response) => {
                    if (response.status === 'success') {

                        $('.area-btn-download').html(`<a href="/src/images/temp/${response.filename}" class="btn btn-success" download>Download</a>`);                        
                        $('#img-preview').attr('src', `/src/images/temp/${response.filename}`);

                        $('#modal-preview').modal('show');

                    }
                },
                error: (err) => {
                    console.log(err);
                }
            });

        });

        return false;
    });

});