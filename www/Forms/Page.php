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

        "content-banner-imgSrc"=>[
          "type"=>"url",
          "placeholder"=>"Entrer l'url de votre #banner",
          "required"=>true,
          "id"=>"input-content-banner-imgSrc",
          "class"=>"mt-5 form-control",
          "value"=>$this->getPresetData('content-banner-imgSrc'),
          "min"=>1,
          "error"=>"Le champ #banner-src ne peut pas être vide",
        ],
        "content-banner-companyTitle"=>[
          "type"=>"text",
          "placeholder"=>"Entrer le titre de votre #banner",
          "required"=>true,
          "id"=>"input-content-banner-companyTitle",
          "class"=>null,
          "value"=>$this->getPresetData('content-banner-companyTitle'),
          "min"=>1,
          "error"=>"Le champ #banner-title ne peut pas être vide",
        ],

        "content-slideshow-one-imgSrc"=>[
          "type"=>"url",
          "placeholder"=>"Entrer l'url de l'image de la #slide-1",
          "required"=>true,
          "id"=>"input-content-slideshow-one-imgSrc",
          "class"=>"mt-5 form-control",
          "value"=>$this->getPresetData('content-slideshow-one-imgSrc'),
          "min"=>1,
          "error"=>"Le champ #slide-1-src ne peut pas être vide",
        ],
        "content-slideshow-one-imgAlt"=>[
          "type"=>"text",
          "placeholder"=>"Entrer l'attribut alt de la #slide-1",
          "required"=>true,
          "id"=>"input-content-slideshow-one-imgAlt",
          "class"=>null,
          "value"=>$this->getPresetData('content-slideshow-one-imgAlt'),
          "min"=>1,
          "error"=>"Le champ #slide-1-alt ne peut pas être vide",
        ],

        "content-slideshow-two-imgSrc"=>[
          "type"=>"url",
          "placeholder"=>"Entrer l'url de l'image de la #slide-2",
          "required"=>true,
          "id"=>"input-content-slideshow-two-imgSrc",
          "class"=>null,
          "value"=>$this->getPresetData('content-slideshow-two-imgSrc'),
          "min"=>1,
          "error"=>"Le champ #slide-2-src ne peut pas être vide",
        ],
        "content-slideshow-two-imgAlt"=>[
          "type"=>"text",
          "placeholder"=>"Entrer l'attribut alt de la #slide-2",
          "required"=>true,
          "id"=>"input-content-slideshow-two-imgAlt",
          "class"=>null,
          "value"=>$this->getPresetData('content-slideshow-two-imgAlt'),
          "min"=>1,
          "error"=>"Le champ #slide-2-alt ne peut pas être vide",
        ],

        "content-slideshow-three-imgSrc"=>[
          "type"=>"url",
          "placeholder"=>"Entrer l'url de l'image de la #slide-3",
          "required"=>true,
          "id"=>"input-content-slideshow-three-imgSrc",
          "class"=>null,
          "value"=>$this->getPresetData('content-slideshow-three-imgSrc'),
          "min"=>1,
          "error"=>"Le champ #slide-3-src ne peut pas être vide",
        ],
        "content-slideshow-three-imgAlt"=>[
          "type"=>"text",
          "placeholder"=>"Entrer l'attribut alt de la #slide-3",
          "required"=>true,
          "id"=>"input-content-slideshow-three-imgAlt",
          "class"=>null,
          "value"=>$this->getPresetData('content-slideshow-three-imgAlt'),
          "min"=>1,
          "error"=>"Le champ #slide-3-alt ne peut pas être vide",
        ],

        "content-cards-one-imgSrc"=>[
          "type"=>"text",
          "placeholder"=>"Entrer l'url de l'image #cards-1",
          "required"=>true,
          "id"=>"input-content-cards-one-imgSrc",
          "class"=>"mt-5 form-control",
          "value"=>$this->getPresetData('content-cards-one-imgSrc'),
          "min"=>1,
          "error"=>"Le champ #cards-1-imgSrc ne peut pas être vide",
        ],
        "content-cards-one-imgAlt"=>[
          "type"=>"text",
          "placeholder"=>"Entrer l'attribut alt de la #cards-1",
          "required"=>true,
          "id"=>"input-content-cards-one-imgAlt",
          "class"=>null,
          "value"=>$this->getPresetData('content-cards-one-imgAlt'),
          "min"=>1,
          "error"=>"Le champ #cards-1-imgAlt ne peut pas être vide",
        ],
        "content-cards-one-title"=>[
          "type"=>"text",
          "placeholder"=>"Entrer le titre de la #cards-1",
          "required"=>true,
          "id"=>"input-content-cards-one-title",
          "class"=>null,
          "value"=>$this->getPresetData('content-cards-one-title'),
          "min"=>1,
          "error"=>"Le champ #cards-1-title ne peut pas être vide",
        ],
        "content-cards-one-p"=>[
          "type"=>"text",
          "placeholder"=>"Entrer le contenu (p) de la #cards-1",
          "required"=>true,
          "id"=>"input-content-cards-one-p",
          "class"=>null,
          "value"=>$this->getPresetData('content-cards-one-p'),
          "min"=>1,
          "error"=>"Le champ #cards-1-p ne peut pas être vide",
        ],

        "content-cards-two-imgSrc"=>[
          "type"=>"text",
          "placeholder"=>"Entrer l'url de l'image #cards-2",
          "required"=>true,
          "id"=>"input-content-cards-two-imgSrc",
          "class"=>null,
          "value"=>$this->getPresetData('content-cards-two-imgSrc'),
          "min"=>1,
          "error"=>"Le champ #cards-2-imgSrc ne peut pas être vide",
        ],
        "content-cards-two-imgAlt"=>[
          "type"=>"text",
          "placeholder"=>"Entrer l'attribut alt de la #cards-2",
          "required"=>true,
          "id"=>"input-content-cards-two-imgAlt",
          "class"=>null,
          "value"=>$this->getPresetData('content-cards-two-imgAlt'),
          "min"=>1,
          "error"=>"Le champ #cards-2-imgAlt ne peut pas être vide",
        ],
        "content-cards-two-title"=>[
          "type"=>"text",
          "placeholder"=>"Entrer le titre de la #cards-2",
          "required"=>true,
          "id"=>"input-content-cards-two-title",
          "class"=>null,
          "value"=>$this->getPresetData('content-cards-two-title'),
          "min"=>1,
          "error"=>"Le champ #cards-2-title ne peut pas être vide",
        ],
        "content-cards-two-p"=>[
          "type"=>"text",
          "placeholder"=>"Entrer le contenu (p) de la #cards-2",
          "required"=>true,
          "id"=>"input-content-cards-two-p",
          "class"=>null,
          "value"=>$this->getPresetData('content-cards-two-p'),
          "min"=>1,
          "error"=>"Le champ #cards-2-p ne peut pas être vide",
        ],

        "content-cards-three-imgSrc"=>[
          "type"=>"text",
          "placeholder"=>"Entrer l'url de l'image #cards-3",
          "required"=>true,
          "id"=>"input-content-cards-three-imgSrc",
          "class"=>null,
          "value"=>$this->getPresetData('content-cards-three-imgSrc'),
          "min"=>1,
          "error"=>"Le champ #cards-3-imgSrc ne peut pas être vide",
        ],
        "content-cards-three-imgAlt"=>[
          "type"=>"text",
          "placeholder"=>"Entrer l'attribut alt de la #cards-3",
          "required"=>true,
          "id"=>"input-content-cards-three-imgAlt",
          "class"=>null,
          "value"=>$this->getPresetData('content-cards-three-imgAlt'),
          "min"=>1,
          "error"=>"Le champ #cards-3-imgAlt ne peut pas être vide",
        ],
        "content-cards-three-title"=>[
          "type"=>"text",
          "placeholder"=>"Entrer le titre de la #cards-3",
          "required"=>true,
          "id"=>"input-content-cards-three-title",
          "class"=>null,
          "value"=>$this->getPresetData('content-cards-three-title'),
          "min"=>1,
          "error"=>"Le champ #cards-3-title ne peut pas être vide",
        ],
        "content-cards-three-p"=>[
          "type"=>"text",
          "placeholder"=>"Entrer le contenu (p) de la #cards-3",
          "required"=>true,
          "id"=>"input-content-cards-three-p",
          "class"=>null,
          "value"=>$this->getPresetData('content-cards-three-p'),
          "min"=>1,
          "error"=>"Le champ #cards-3-p ne peut pas être vide",
        ],

        "content-quote-quote"=>[
          "type"=>"url",
          "placeholder"=>"Entrer le contenu de votre #quote",
          "required"=>true,
          "id"=>"input-content-quote-quote",
          "class"=>"mt-5 form-control",
          "value"=>$this->getPresetData('content-quote-quote'),
          "min"=>1,
          "error"=>"Le champ #quote ne peut pas être vide",
        ],
        "content-quote-author"=>[
          "type"=>"text",
          "placeholder"=>"Entrer l'auteur de votre #quote-author",
          "required"=>true,
          "id"=>"input-content-quote-author",
          "class"=>null,
          "value"=>$this->getPresetData('content-quote-author'),
          "min"=>1,
          "error"=>"Le champ #quote-author ne peut pas être vide",
        ],
        "content-quote-info"=>[
          "type"=>"text",
          "placeholder"=>"Entrer les informations de votre #quote-info",
          "required"=>true,
          "id"=>"input-content-quote-info",
          "class"=>null,
          "value"=>$this->getPresetData('content-quote-info'),
          "min"=>1,
          "error"=>"Le champ #quote-info ne peut pas être vide",
        ],

        "content-footer-companyTitle"=>[
          "type"=>"url",
          "placeholder"=>"Entrer le contenu de votre #footer-companyTitle",
          "required"=>true,
          "id"=>"input-content-footer-companyTitle",
          "class"=>"mt-5 form-control",
          "value"=>$this->getPresetData('content-footer-companyTitle'),
          "min"=>1,
          "error"=>"Le champ #footer-companyTitle ne peut pas être vide",
        ],
        "content-footer-footerColor"=>[
          "type"=>"color",
          "placeholder"=>"Entrer la couleur de votre #footer-footerColor",
          "required"=>true,
          "id"=>"input-content-footer-footerColor",
          "class"=>null,
          "value"=>$this->getPresetData('content-footer-footerColor'),
          "min"=>1,
          "error"=>"Le champ #footer-footerColor ne peut pas être vide",
        ],
      ],
    ];

    $this->config = [
      "config"=>[
          "method"=>$this->method,
          "action"=>"",
          "class"=>"col-6",
          "id"=>"form-page",
          "submit"=>"Envoyer",
          "cancel"=>"Annuler",
          "redirectIfCancel"=>"dashboard",
          "title"=>"Créer une page"
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