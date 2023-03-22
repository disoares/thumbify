<?php

require_once('vendor/autoload.php');
require_once('src/config/Config.php');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Slim\App as App;

use App\model\Model;
use App\model\LoadTpl;

$app = new App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

$app->get('/', function (Request $request, Response $response, array $args) {
    $loadTpl = new LoadTpl(array(
        'title' => 'Redimensionar',
        'description' => 'Redimensionar imagem grátis',
        'keywords' => 'Thumbnail, Resize Image, Resize, Image, Cut, Crop, Crip Image',
        'author' => 'Diego Soares',
    ), 'thumbify', [], ['resize.js']);
});

$app->post('/upload', function (Request $request, Response $response, array $args) {
    $model = new Model();
    return $model->uploadFile($_FILES['image-to-thumbify']);
});

$app->post('/resize', function (Request $request, Response $response, array $args) {
    $model = new Model();

    if (isset($_POST['radioSize'])) {
        echo $model->resizeImage(TEMP_PATH . $_FILES['image-to-thumbify']['name'], $_POST['radioSize']);
    } else {
        echo $model->cropImage(TEMP_PATH . $_FILES['image-to-thumbify']['name'], $_FILES['imageToCropped']);
    }
});

$app->get('/crop', function (Request $request, Response $response, array $args) {
    $loadTpl = new LoadTpl(array(
        'title' => 'Cortar',
        'description' => 'Cortar imagem grátis',
        'keywords' => 'Thumbnail, Resize Image, Resize, Image, Cut, Crop, Crip Image',
        'author' => 'Diego Soares',
    ), 'crop', ['cropper.css'], ['cropper.js', 'crop.js']);
});

$app->get('/push-notification', function (Request $request, Response $response, array $args) {
    $loadTpl = new LoadTpl(array(
        'title' => 'Firebase Push Notification',
        'description' => 'Testar firebase push notication',
        'keywords' => 'Firebase, push notification, notificações, testar push notification, fcm',
        'author' => 'Diego Soares',
    ), 'push-notification', ['cropper.css'], ['firebase.js']);
});

$app->post('/send-push-notification', function (Request $request, Response $response, array $args) {
    $json = array();
    $json['status'] = 'success';

    $serveKey = $_POST['serveKey'];
    $deviceToken = $_POST['deviceToken'];
    $title = $_POST['title'];
    $message = $_POST['message'];

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => '{
                "to":"' . $deviceToken . '",
                "notification" : {
                    "body" : "' . $message . '",
                    "title": "' . $title . '"
                },
                "data" : {
                    "body" : "' . $message . '",
                    "title": "' . $title . '"
                }
            }',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Authorization: key=' . $serveKey
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    echo json_encode($json);
});

$app->get('/delete', function (Request $request, Response $response, array $args) {
    $model = new Model();
    $model->deleteFiles();
});

$app->run();
