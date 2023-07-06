<?php
namespace App\core;

use App\core\DotEnv;
use App\core\Security;
use App\models\Page;

final class Router
{
    private static ?Router $_instance = null;
    private static $routes;

    private $controller;
    private $action;
    private $permission;
    private $actionParameter;

    public function setController($controller): void
    {
        $this->controller = $controller;
    }

    public function setAction($action): void
    {
        $this->action = $action;
    }

    public function setPermission(?array $permission): void
    {
        $this->permission = $permission;
    }

    public function setActionParameter($actionParameter): void
    {
        $this->actionParameter = $actionParameter;
    }

    public function getController(): string
    {
        return $this->controller;
    }

    public function getAction(): string
    {
        return $this->action;
    }

    public function getActionParameter()
    {
        return $this->actionParameter;
    }

    public function getPermission(): ?array
    {
        return $this->permission;
    }

    public static function getInstance(): Router
    {
        if(is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    private function __construct()
    {
        self::$routes = yaml_parse_file("./routes.yml");
    }

    /**
     * @param Users $user
     * @return array
     */
    public function getRoute()
    {
        $slug = $this->currentSlug();

        (new DotEnv(dirname(dirname(__DIR__)).'/html/.env'))->load();

        //Si cms non installé, on ne laisse pas l'accès hors de l'installation
        if(!$_ENV['INSTALLED'] && self::$routes[$slug]["controller"] !== 'Deploy'){
            header('Location: /'.$this->getSlug('Deploy', 'deployDb'));
        }

        //Si le cms est installé, on autorise pas l'accès à l'installation
        if($_ENV['INSTALLED'] && isset(self::$routes[$slug]) && self::$routes[$slug]["controller"] == 'Deploy'){
            header('Location: /');
        }

        //Si l'uri n'existe pas dans $routes die page 404
        if(!$this->isSlugExist($slug)) {
            die("Page 404 : Not found / ERROR #1");
        }

        //Sinon si il n'y a pas de fichier controller correspondant die absence du fichier controller
        if(!file_exists("controllers/".$this->getController().".php")) {
            die("Page 404 : Not found / ERROR #5");
        }

        //Sinon si l'action n'existe pas die action inexistante
        include "controllers/".$this->getController().".php";
        $namespaceController = "App\controllers\\";
        if(!class_exists($namespaceController.$this->getController())){
            die("Page 404 : Not found / ERROR #6");
        }

        if ($this->getPermission() && !Security::hasRole($this->getPermission())) {
            header('Location: /'.$this->getSlug('Security', 'login'));
        }

        /** @TODO add the singleton principle to the controller call and if possible to the action */
        $controller = new ($namespaceController.$this->getController())();

        //Sinon appel de l'action
        if(!method_exists($controller, $this->getAction())){
            die("Page 404 : Not found / ERROR #7");
        }

        return $controller->{$this->getAction()}($this->getActionParameter());
    }

    public function isSlugExist(String $slug): bool
    {
        // verifie si le slug existe dans le fichier routes.yml
        // verifie si le slug existe en base de données
        if (!empty(self::$routes[$slug])) {
            //Sinon si l'uri ne possède pas de controller ni d'action die erreur fichier routes.yml
            if(!empty(self::$routes[$slug]["controller"])) {
                $this->setController(self::$routes[$slug]["controller"]);
            } else {
                die("Page 404 : Not found / ERROR #2");
            }

            if (!empty(self::$routes[$slug]["action"])) {
                $this->setAction(self::$routes[$slug]["action"]);
            } else {
                die("Page 404 : Not found / ERROR #3");
            }

            if (!empty(self::$routes[$slug]["permission"])) {
                $this->setPermission(self::$routes[$slug]["permission"]);
            } else {
                $this->setPermission(null);
            }

            return true;
        }

        $this->setController("PageController");
        $this->setAction("displayPage");
        $this->setPermission(null);

        $page = new Page();
        $page = $page::getOneBy(['slug'=>$slug]);
        if($page && $page->isPageActive()) {
            $this->setActionParameter($page);
            return true;
        }

        return false;
    }

    /**
     * return slug in request uri
     *
     * @return string
     */
    public function currentSlug(): string
    {
        $uri = explode("?", $_SERVER["REQUEST_URI"]);
        if (empty($uri[0]) || $uri[0] == "/") {
            return "default";
        }
        return trim(strtolower($uri[0]), '/');
    }

    /**
     * return slug function
     *
     * @param [string] $controller
     * @param [string] $action
     * @return string
     */
    public function getSlug($controller, $action): string
    {
        foreach (self::$routes as $slug => $route) {
            if (!empty($route["controller"]) && !empty($route["action"]) && ucfirst($route["controller"]) == ucfirst($controller) && $route["action"] == $action)
                return $slug;
        }

        return "/";
    }
}