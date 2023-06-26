<?php
namespace App\Forms;

use App\core\Validator;

class PageComment extends Validator {

    public $config = [];

    public $method = "POST";

    public function __construct()
    {
        $this->config = [
            "config"=>[
                "method"=>$this->method,
                "action"=>"",
                "id"=>"form-login",
                "submit"=>"Ajouter un commentaire",
                "cancel"=>"Annuler",
                "redirectIfCancel"=>"#",
                "title"=>"Ajouter un commentaire",
                "class"=>"col-12",
                "sectionClass"=>"col-6"
            ],
            "inputs"=>[
                "content"=>[
                    "type"=>"text",
                    "placeholder"=>"Votre commentaire",
                    "required"=>true,
                    "id"=>"input-content",
                    "class"=>null,
                    "error"=>"Votre commentaire est incorrect"
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