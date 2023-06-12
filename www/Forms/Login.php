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
                "class"=>"form",
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
                    "class"=>"input-text",
                    "error"=>"Votre email est incorrect"
                ],
                "pwd"=>[
                    "type"=>"password",
                    "placeholder"=>"Votre mot de passe",
                    "required"=>true,
                    "id"=>"input-pwd",
                    "class"=>"input-text"
                ],
                "radioTest"=>[
                    "type"=>"radio",
                    "id"=>"input-radioTest",
                    "class"=>"input-text",
                    "error"=>"Vous devez séléctioner une valeur",
                    "group"=>"radioTest",
                    "options"=>[
                        [
                            "label"=>"one",
                            "value"=>"one"
                        ],
                        [
                            "label"=>"two",
                            "value"=>"two"
                        ],
                    ],
                ],
                "checkboxTest"=>[
                    "type"=>"checkbox",
                    "id"=>"input-checkboxTest",
                    "class"=>"input-text",
                    "error"=>"Vous devez séléctioner une valeur",
                    "options"=>[
                        [
                            "id"=>"checkboxOne",
                            "label"=>"checkboxOne",
                            "name"=>"checkboxOne",
                            "value"=>"checkboxOne"
                        ],
                        [
                            "id"=>"checkboxTwo",
                            "label"=>"checkboxTwo",
                            "name"=>"checkboxTwo",
                            "value"=>"checkboxTwo"
                        ],
                    ],
                ],
                "selectTest"=>[
                    "type"=>"select",
                    "id"=>"input-selectTest",
                    "class"=>"input-text",
                    "error"=>"Vous devez séléctioner une valeur",
                    "options"=>[
                        [
                            "label"=>"selectOne",
                            "value"=>"selectOne"
                        ],
                        [
                            "label"=>"selectTwo",
                            "value"=>"selectTwo"
                        ],
                    ],
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