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

    if(isset($_POST['radioSize'])){
        echo $model->resizeImage(TEMP_PATH . $_FILES['image-to-thumbify']['name'], $_POST['radioSize']);
    }else{
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

$app->get('/delete', function (Request $request, Response $response, array $args) {
    $model = new Model();
    $model->deleteFiles();
});

$app->run();
