<?php

namespace App\model;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;
use \Slim\App as App;
use Rain\Tpl;

class LoadTpl {

    private $tpl;

    public function __construct($metas, $page, $styles = [], $scripts = []) {

        // config
        $config = array(
            "tpl_dir"       => $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "views/",
            "cache_dir"     => $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . "views-cache/",
            "true"         => false, // set to false to improve the speed
        );
        Tpl::configure($config);

        $this->tpl = new Tpl();

        $this->tpl->assign('styles', $styles);
        $this->tpl->assign('scripts', $scripts);

        foreach($metas as $k => $meta){
            $this->tpl->assign($k, $meta);
        }

        $this->tpl->draw('header');
        $this->tpl->draw($page);
    }

    public function __destruct() {
        $this->tpl->draw('footer');
    }

}