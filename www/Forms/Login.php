<?php
namespace App\Forms;

use App\core\Validator;

class Login extends Validator {

    public $config = [];

    public $method = "POST";

    public function __construct()
    {
        $this->config = [
            "config"=>[
                "method"=>$this->method,
                "action"=>"",
                "class"=>null,
                "id"=>"form-login",
                "submit"=>"Se connecter",
                "cancel"=>"Annuler"
            ],
            "inputs"=>[
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email",
                    "required"=>true,
                    "id"=>"input-email",
                    "class"=>null,
                    "error"=>"Votre email est incorrect"
                ],
                "pwd"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe",
                    "required"=>true,
                    "id"=>"input-pwd",
                    "class"=>null
                ],
                "wysiwygTest"=>[
                    "type"=>"wysiwyg",
                    "placeholder"=>"Votre mot de passe",
                    "required"=>true,
                    "id"=>"input-wysiwyg",
                    "class"=>null
                ],
                "wysiwygTest2"=>[
                    "type"=>"wysiwyg",
                    "placeholder"=>"Votre mot de passe",
                    "required"=>true,
                    "id"=>"input-wysiwyg-2",
                    "class"=>null
                ]
            ]
        ];

        parent::__construct();
    }

    public function getConfig(): array
    {
        return $this->config;
    }

}