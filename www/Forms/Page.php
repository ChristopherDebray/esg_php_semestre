<?php
namespace App\Forms;

use App\core\Validator;

class Page extends Validator {
  public $config = [];
  public $presetData = null;
  public $method = "POST";
  private $themes;

  public function __construct($selectedTheme, $presetData = null)
  {
    $this->presetData = $presetData;
    $this->themes = [
      1=>[
        "title"=>[
          "type"=>"text",
          "placeholder"=>"Le titre de votre page",
          "required"=>true,
          "id"=>"input-email",
          "class"=>null,
          "min"=>5,
          "max"=>60,
          "error"=>"Votre titre doit faire entre 5 et 60 caractères",
          "value"=>$this->getPresetData('title'),
        ],
        "config-keywords"=>[
          "type"=>"text",
          "placeholder"=>"Entrer les mots-clés de page pour la partie SEO",
          "required"=>false,
          "id"=>"input-config-keywords",
          "class"=>null,
          "value"=>$this->getPresetData('config-keywords'),
        ],
        "config-description"=>[
          "type"=>"text",
          "placeholder"=>"Entrer la description de page pour la partie SEO",
          "required"=>false,
          "id"=>"input-config-description",
          "class"=>null,
          "value"=>$this->getPresetData('config-description'),
        ],
        "content-block-one"=>[
          "type"=>"wysiwyg",
          "placeholder"=>"Entrer le contenu de votre #block-1",
          "required"=>true,
          "id"=>"input-content-one",
          "class"=>null,
          "value"=>$this->getPresetData('content-block-one'),
          "min"=>1,
          "error"=>"Le champ #block-1 ne peut pas être vide",
        ],
        "content-block-two"=>[
          "type"=>"wysiwyg",
          "placeholder"=>"Entrer le contenu de votre #block-2",
          "required"=>true,
          "id"=>"input-content-two",
          "class"=>null,
          "value"=>$this->getPresetData('content-block-two'),
          "min"=>1,
          "error"=>"Le champ #block-2 ne peut pas être vide",
        ],
        "content-footer"=>[
          "type"=>"wysiwyg",
          "placeholder"=>"Entrer le contenu de votre #footer",
          "required"=>true,
          "id"=>"input-content-footer",
          "class"=>null,
          "value"=>$this->getPresetData('content-footer'),
          "min"=>1,
          "error"=>"Le champ #footer ne peut pas être vide",
        ]
      ],
    ];

    $this->config = [
      "config"=>[
          "method"=>$this->method,
          "action"=>"",
          "class"=>null,
          "id"=>"form-login",
          "submit"=>"Se connecter",
          "cancel"=>"Annuler",
          "redirectIfCancel"=>"dashboard",
      ],
      "inputs"=>$this->themes[$selectedTheme]
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

  private function getJsonFromGroupedFormData($data, $dataGroup)
  {
    $result = [];
    foreach ($data as $key => $value) {
      if (strpos($key, $dataGroup) === 0) {
        $result[$key] = $value;
      }
    }

    return $result;
  }

  private function getPresetData($key)
  {
    return ($this->presetData && $this->presetData[$key]) ? $this->presetData[$key] : null;
  }
}