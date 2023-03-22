$(() => {
    $('#form-push-notification').on('submit', () => {

        const serveKey = $('#server-key').val();
        const deviceToken = $('#device-token').val();
        const title = $('#title').val();
        const message = $('#message').val();

        $.ajax({
            url: "/send-push-notification",
            type: "post",
            dataType: "json",
            data: {
                serveKey: serveKey,
                deviceToken: deviceToken,
                title: title,
                message: message
            },
            beforeSend: () => {
                $('#btn-send-push-notification').html(loading('Enviando...'));
            },
            success: (response) => {
                clearLoading('#btn-send-push-notification', 'Enviar notificação');

                if (response.status === 'success') {
                    swal("Tudo certo!", "Notificação enviada com sucesso!", "success");
                }
            },
            error: (err) => {
                clearLoading('#btn-send-push-notification', 'Enviar notificação');
                console.log(err);
            }
        });

        return false;
    });

    const loading = (msg) => {
        return `
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        &nbsp;&nbsp;${msg}
    `;
    };

    const clearLoading = (elem, text) => {
        $(elem).text(text);
    };

});