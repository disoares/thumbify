<?php

require_once('vendor/autoload.php');
require_once('src/config/Config.php');

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Slim\App as App;
use Rain\Tpl;

use App\model\Model;

// config
$config = array(
    "tpl_dir"       => "views/",
    "cache_dir"     => "views-cache/",
    "true"         => false, // set to false to improve the speed
);
Tpl::configure($config);

$app = new App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);

$app->get('/', function (Request $request, Response $response, array $args) {

    $tpl = new Tpl();

    $tpl->assign('title', 'Thumbify');
    $tpl->assign('description', 'Free image resize');
    $tpl->assign('keywords', 'Thumbnail, Resize Image, Resize, Image, Cut, Crop, Crip Image');
    $tpl->assign('author', 'Diego Soares');

    $tpl->draw('header');
    $tpl->draw('thumbify');
    $tpl->draw('footer');
});

$app->post('/upload', function (Request $request, Response $response, array $args) {
    $model = new Model();
    return $model->uploadFile($_FILES['image-to-thumbify']);
});

$app->post('/resize', function (Request $request, Response $response, array $args) {

    $path = TEMP_PATH . $_FILES['image-to-thumbify']['name'];

    $model = new Model();
    echo $model->resizeImage($path, $_POST['radioSize']);
});

$app->get('/delete', function (Request $request, Response $response, array $args) {
    $model = new Model();
    $model->deleteFiles();
});

$app->run();
