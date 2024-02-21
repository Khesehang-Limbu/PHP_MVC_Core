<?php
namespace app\core;

use app\core\middlewares\BaseMiddleware;

class Controller{
    public string $layout = "main";
    public string $action = "";

    /* @var BaseMiddleware[] */
    protected array $middleWares = [];

    public function render($view, $params){
        return Application::$app->view->renderView($view, $params);
    }

    public function setLayout($layout){
        $this->layout = $layout;
    }

    public function registerMiddleware(BaseMiddleware $middleware){
        $this->middleWares[] = $middleware;
    }

    public function getMiddlewares(){
        return $this->middleWares;
    }
}
