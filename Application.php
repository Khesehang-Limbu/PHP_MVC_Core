<?php

namespace evil\phpmvc;
use evil\phpmvc\db\Database;

class Application
{
    public const EVENT_BEFORE_REQUEST = "before";
    public const EVENT_AFTER_REQUEST = "after";

    protected array $eventListeners = [];

    public string $layout = "main";
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    public View $view;
    public ?UserModel $user;

    public string $userClass;

    public static $ROOT_DIR;
    public static Controller $controller;

    public function __construct($rootPath, array $config)
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->db = new Database($config['db']);
        $this->session = new Session();
        $this->view = new View();
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;

        $this->userClass = $config["userClass"];
        $primaryValue = $this->session->get('user');

        if ($primaryValue) {
            $u = new $this->userClass();
            $primaryKey = $u->primaryKey('user');
            $this->user = $u->findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
    }

    public function run()
    {
        $this->triggerEvent(self::EVENT_BEFORE_REQUEST);
        try {
            echo $this->router->resolve();
        } catch (\Throwable $th) {
            $context = ["exception" => $th];
            $this->response->setStatusCode($th->getCode());
            echo $this->view->renderView("_error", $context);
        }
    }

    public function login(UserModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set("user", $primaryValue);
        return true;
    }

    public function logout()
    {
        $this->user = null;
        $this->session->remove("user");
    }

    public static function isGuest()
    {
        return !self::$app->user;
    }

    public function on($event, $callback){
        $this->eventListeners[$event][] = $callback;
    }

    public function triggerEvent($event){
        $callbacks = $this->eventListeners[$event];

        foreach ($callbacks as $event) {
            call_user_func($event);
        }
    }
}
