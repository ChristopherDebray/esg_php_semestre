<?php
namespace App\Forms\deploy;

use App\core\Validator;
use App\core\Router;

class DeployDb extends Validator {

    public $config = [];

    public $method = "POST";

    public function __construct()
    {
        $this->config = [
            "config"=>[
                "method"=>$this->method,
                "action"=>"",
                "class"=>null,
                "id"=>"form-db",
                "submit"=>"Connecter la base de données"
            ],
            "inputs"=>[
                "db_host"=>[
                    "type"=>"text",
                    "placeholder"=>"Serveur de la base",
                    "required"=>true,
                    "id"=>"db_host",
                    "class"=>"form-control",
                    "error"=>"Le serveur hôte est requis"
                ],
                "db_name"=>[
                    "type"=>"text",
                    "placeholder"=>"Nom de la base",
                    "required"=>true,
                    "id"=>"db_name",
                    "class"=>"form-control",
                    "error"=>"Le nom de la base de donnée est requis"
                ],
                "db_user"=>[
                    "type"=>"text",
                    "placeholder"=>"User BDD",
                    "required"=>true,
                    "id"=>"db_user",
                    "class"=>"form-control",
                    "error"=>"Le nom de l'utilisateur de la base de donnée est requis"
                ],
                "db_pwd"=>[
                    "type"=>"password",
                    "placeholder"=>"Mot de passe BDD",
                    "required"=>true,
                    "id"=>"db_pwd",
                    "class"=>"form-control",
                    "error"=>"Le mot de passe de la base de donnée est requis"
                ],
                "db_prefix"=>[
                    "type"=>"text",
                    "placeholder"=>"Préfixe des tables",
                    "required"=>false,
                    "id"=>"db_prefix",
                    "class"=>"form-control",
                    "error"=>""
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