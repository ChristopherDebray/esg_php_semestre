<?php
namespace App\Forms;

use App\core\Validator;

class UpdateUser extends Validator {
    public $config = [];
    public $method = "POST";

    public function __construct($user)
    {
        var_dump($user->getFirstname());
        $this->config = [
            "config"=>[
                "method"=>$this->method,
                "action"=>"",
                "class"=>null,
                "id"=>"form-update-user",
                "submit"=>"Modifier l'utilisateur",
                "cancel"=>"Annuler"
            ],
            "inputs"=>[
                "firstname"=>[
                    "type"=>"text",
                    "placeholder"=>"Prénom",
                    "required"=>true,
                    "id"=>"firstname",
                    "class"=>null,
                    "error"=>"Prénom incorrect",
                    "value"=>$user->getFirstname()
                ],
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Votre email",
                    "required"=>true,
                    "id"=>"input-email",
                    "class"=>null,
                    "error"=>"Votre email est incorrect"
                ],
            ]
        ];

        parent::__construct();
    }

    public function getConfig(): array
    {
        return $this->config;
    }

}