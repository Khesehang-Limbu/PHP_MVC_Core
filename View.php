<?php

namespace evil\phpmvc;

class View
{
    public string $title = "";

    public function renderView($view, $params = [])
    {
        $viewContent = $this->renderOnlyView($view, $params);
        $layout = $this->renderContent($viewContent);
        return str_replace("{{content}}", $viewContent, $layout);
    }

    public function layoutContent()
    {
        $layout = Application::$app->layout;

        if (Application::$app->controller??false) {
            $layout = Application::$app->controller->layout;
        }

        ob_start();
        include_once(realpath(Application::$ROOT_DIR . "/../views/layouts/$layout.php"));
        return ob_get_clean();
    }

    public function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace("{{content}}", $viewContent, $layoutContent);
    }

    public function renderOnlyView($view, $params)
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once realpath(Application::$ROOT_DIR . "/../views/$view.php");
        return ob_get_clean();
    }
}
