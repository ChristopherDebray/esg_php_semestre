<?php
namespace App\core;

class View{

    private $view;
    private $template;
    private $data = [];

    public function __construct(String $view, String $template = "back")
    {
        $this->setView($view);
        $this->setTemplate($template);
    }

    public function __toString(): string
    {
        return "Le template c'est ".$this->template." et la vue c'est ".$this->view;
    }

    public function setView(String $view): void
    {
        if( !file_exists("views/".$view.".php")){
            // La vue n'existe pas
            Router::error404();
            exit();
        }else{
            $this->view = "views/".$view.".php";
        }
    }
    public function setTemplate(String $template): void
    {
        if( !file_exists("views/".$template.".php")){
            // Le template n'existe pas
            Router::error404();
            exit();
        }else{
            $this->template = "views/".$template.".php";
        }
    }

    public function assign($key, $value): void
    {
        $this->data[$key] = $value;
    }

    public function modal($name, $config, $errors): void
    {
        if(!file_exists("views/modals/".$name.".modal.php")){
            // Le modal n'existe pas
            Router::error404();
            exit();
        }
        include "views/modals/".$name.".modal.php";
    }

    public function __destruct()
    {
        extract($this->data);
        include $this->template;
    }
}
