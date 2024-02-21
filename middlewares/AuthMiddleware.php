<?php

namespace evil\phpmvc\middlewares;

use evil\phpmvc\Application;
use evil\phpmvc\exceptions\ForbiddenException;

class AuthMiddleware extends BaseMiddleware
{
    public array $actions;

    public function __construct($actions = [])
    {
        $this->actions = $actions;
    }

    public function execute()
    {
        if (Application::$app->isGuest()) {
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                throw new ForbiddenException();
            }
        }
    }
}
