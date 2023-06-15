<?php
namespace App\Forms;

use App\core\Validator;

class Page extends Validator {
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
        "title"=>[
          "type"=>"text",
          "placeholder"=>"Le titre de votre page",
          "required"=>true,
          "id"=>"input-email",
          "class"=>null,
          "min"=>2,
          "error"=>"Votre tire doit faire entre 3 et 60 caractères"
        ],
        "config-keywords"=>[
          "type"=>"text",
          "placeholder"=>"Entrer les mots-clés de page pour la partie SEO",
          "required"=>true,
          "id"=>"input-config-keywords",
          "class"=>null
        ],
        "config-description"=>[
          "type"=>"text",
          "placeholder"=>"Entrer la description de page pour la partie SEO",
          "required"=>true,
          "id"=>"input-config-description",
          "class"=>null
        ],
        "content-block-one"=>[
          "type"=>"wysiwyg",
          "placeholder"=>"Entrer le contenu de votre #block-1",
          "required"=>true,
          "id"=>"input-content-one",
          "class"=>null
        ],
        "content-block-two"=>[
          "type"=>"wysiwyg",
          "placeholder"=>"Entrer le contenu de votre #block-2",
          "required"=>true,
          "id"=>"input-content-two",
          "class"=>null
        ],
        "content-footer"=>[
          "type"=>"wysiwyg",
          "placeholder"=>"Entrer le contenu de votre #footer",
          "required"=>true,
          "id"=>"input-content-footer",
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

  public function getFormattedData($data)
  {
    unset($data['submit']);
    return [
      "title"=>$data['title'],
      "config"=>json_encode($this->getJsonFromGroupedFormData($data, 'config')),
      "content"=>json_encode($this->getJsonFromGroupedFormData($data, 'content')),
    ];
  }

  public function getJsonFromGroupedFormData($data, $dataGroup)
  {
    $result = [];
    foreach ($data as $key => $value) {
      if (strpos($key, $dataGroup) === 0) {
        $result[$key] = $value;
      }
    }

    return $result;
  }
}