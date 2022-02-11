<?php if(!class_exists('Rain\Tpl')){exit;}?><section class="container col-md-6 offset-md-3 section-image-to-thumbify">
    <div class="area-form-image-to-thumbify col-md-12">
        <form id="form-image-to-thumbify" name="form-image-to-thumbify" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image-to-thumbify">Selecione uma imagem</label>
                <div>
                    <button type="button" class="btn btn-primary col-md-12 btn-add-image"
                        onclick="$('#image-to-thumbify').trigger( 'click' )">
                        <span class="material-icons md-2">
                            file_upload
                        </span>&nbsp;
                        Escolha uma imagem
                    </button>
                    <span class="text-danger help-block"></span>
                </div>
                <input type="file" class="form-control-file" name="image-to-thumbify" id="image-to-thumbify" hidden>
                <div class="mt-4 area-image-to-thumbify">
                    <div class="uploaded-image">
                        <img alt="image to resize" class="img-to-thumbify" id="img-to-thumbify">
                    </div>
                    <div class="area-drag-and-drop" id="area-drag-and-drop">
                        <div>
                            <span class="material-icons md-5">
                                file_download
                            </span>
                        </div>
                        Ou arraste uma imagem e solte aqui
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="radio-area">
                    <div>
                        <label for="">Eu quero redimensionar a minha imagem para:</label>
                    </div>
                    <div class="form-check form-check-inline" data-toggle="tooltip" data-placement="top"
                        title="Max width: 150px">
                        <input class="form-check-input" type="radio" name="radioSize" id="inlineRadio1" value="150">
                        <label class="form-check-label" for="inlineRadio1">Muito pequena</label>
                    </div>
                    <div class="form-check form-check-inline" data-toggle="tooltip" data-placement="top"
                        title="Max width: 300px">
                        <input class="form-check-input" type="radio" name="radioSize" id="inlineRadio2" value="300">
                        <label class="form-check-label" for="inlineRadio2">Pequena</label>
                    </div>
                    <div class="form-check form-check-inline" data-toggle="tooltip" data-placement="top"
                        title="Max width: 600px">
                        <input class="form-check-input" type="radio" name="radioSize" id="inlineRadio3" value="600"
                            checked>
                        <label class="form-check-label" for="inlineRadio3">Média</label>
                    </div>
                    <div class="form-check form-check-inline" data-toggle="tooltip" data-placement="top"
                        title="Max width: 1200px">
                        <input class="form-check-input" type="radio" name="radioSize" id="inlineRadio4" value="1200">
                        <label class="form-check-label" for="inlineRadio4">Grande</label>
                    </div>
                    <div class="form-check form-check-inline" data-toggle="tooltip" data-placement="top"
                        title="Max width: 1920px">
                        <input class="form-check-input" type="radio" name="radioSize" id="inlineRadio5" value="1920">
                        <label class="form-check-label" for="inlineRadio5">Muito grande</label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary col-md-4 offset-md-4" id="btn-submit" disabled>Processar imagem</button>
                <span class="text-danger help-block"></span>
            </div>
        </form>
        <div class="area-btn-download">
        </div>
    </div>
</section>

<section class="container col-md-8 offset-md-2">
    <article>
        <h2 class="text-center">Why do I need a small image?</h2>
        <p>
            In web development, we face with this question ofter. But after all, what is the answer?
            It's simple... when a user access our website, they do requests to our server and download the images that
            appear on the page.
            Small images will help us to make our website faster.
            Create Youtube thumbnail is another possible use to the Thumbify.
            Remember this, your website SEO work will be rewarded by search engines... if it is fast. If you wish appear
            on first page, worry about it.
        </p>
        <h2 class="text-center mt-4">Why should I use Thumbify?</h2>
        <p>
            Because it's my website <span class="material-icons">mood</span>
        </p>
        <p>
            It was a joke lol
            You should use Thumbify because we don't save your data. Our policy it's privacy! So, keep calm and use
            Thumbify.
        </p>
    </article>
</section>