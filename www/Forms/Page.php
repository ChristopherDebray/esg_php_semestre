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
          "type"=>"url",
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
          "type"=>"url",
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
          "type"=>"url",
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
          "type"=>"text",
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
      ],
      2=>[
        "content-posts-one-imgSrc"=>[
          "type"=>"url",
          "placeholder"=>"Entrer l'url de l'image #posts-1-imgSrc",
          "required"=>true,
          "id"=>"input-content-posts-one-imgSrc",
          "class"=>"mt-5 form-control",
          "value"=>$this->getPresetData('content-posts-one-imgSrc'),
          "min"=>1,
          "error"=>"Le champ #posts-1-imgSrc ne peut pas être vide",
        ],
        "content-posts-one-imgAlt"=>[
          "type"=>"text",
          "placeholder"=>"Entrer l'attribut alt du #posts-1-imgAlt",
          "required"=>true,
          "id"=>"input-content-posts-one-imgAlt",
          "class"=>null,
          "value"=>$this->getPresetData('content-posts-one-imgAlt'),
          "min"=>1,
          "error"=>"Le champ #posts-1-imgAlt ne peut pas être vide",
        ],
        "content-posts-one-title"=>[
          "type"=>"text",
          "placeholder"=>"Entrer le titre du #posts-1-title",
          "required"=>true,
          "id"=>"input-content-posts-one-title",
          "class"=>null,
          "value"=>$this->getPresetData('content-posts-one-title'),
          "min"=>1,
          "error"=>"Le champ #posts-1-title ne peut pas être vide",
        ],
        "content-posts-one-text"=>[
          "type"=>"text",
          "placeholder"=>"Entrer le contenu du #posts-1-text",
          "required"=>true,
          "id"=>"input-content-posts-one-text",
          "class"=>null,
          "value"=>$this->getPresetData('content-posts-one-text'),
          "min"=>1,
          "error"=>"Le champ #posts-1-text ne peut pas être vide",
        ],

        "content-posts-two-imgSrc"=>[
          "type"=>"url",
          "placeholder"=>"Entrer l'url de l'image #posts-1-imgSrc",
          "required"=>true,
          "id"=>"input-content-posts-two-imgSrc",
          "class"=>"mt-5 form-control",
          "value"=>$this->getPresetData('content-posts-two-imgSrc'),
          "min"=>1,
          "error"=>"Le champ #posts-1-imgSrc ne peut pas être vide",
        ],
        "content-posts-two-imgAlt"=>[
          "type"=>"text",
          "placeholder"=>"Entrer l'attribut alt du #posts-1-imgAlt",
          "required"=>true,
          "id"=>"input-content-posts-two-imgAlt",
          "class"=>null,
          "value"=>$this->getPresetData('content-posts-two-imgAlt'),
          "min"=>1,
          "error"=>"Le champ #posts-1-imgAlt ne peut pas être vide",
        ],
        "content-posts-two-title"=>[
          "type"=>"text",
          "placeholder"=>"Entrer le titre du #posts-1-title",
          "required"=>true,
          "id"=>"input-content-posts-two-title",
          "class"=>null,
          "value"=>$this->getPresetData('content-posts-two-title'),
          "min"=>1,
          "error"=>"Le champ #posts-1-title ne peut pas être vide",
        ],
        "content-posts-two-text"=>[
          "type"=>"text",
          "placeholder"=>"Entrer le contenu du #posts-1-text",
          "required"=>true,
          "id"=>"input-content-posts-two-text",
          "class"=>null,
          "value"=>$this->getPresetData('content-posts-two-text'),
          "min"=>1,
          "error"=>"Le champ #posts-1-text ne peut pas être vide",
        ],

        "content-posts-three-imgSrc"=>[
          "type"=>"url",
          "placeholder"=>"Entrer l'url de l'image #posts-1-imgSrc",
          "required"=>true,
          "id"=>"input-content-posts-three-imgSrc",
          "class"=>"mt-5 form-control",
          "value"=>$this->getPresetData('content-posts-three-imgSrc'),
          "min"=>1,
          "error"=>"Le champ #posts-1-imgSrc ne peut pas être vide",
        ],
        "content-posts-three-imgAlt"=>[
          "type"=>"text",
          "placeholder"=>"Entrer l'attribut alt du #posts-1-imgAlt",
          "required"=>true,
          "id"=>"input-content-posts-three-imgAlt",
          "class"=>null,
          "value"=>$this->getPresetData('content-posts-three-imgAlt'),
          "min"=>1,
          "error"=>"Le champ #posts-1-imgAlt ne peut pas être vide",
        ],
        "content-posts-three-title"=>[
          "type"=>"text",
          "placeholder"=>"Entrer le titre du #posts-1-title",
          "required"=>true,
          "id"=>"input-content-posts-three-title",
          "class"=>null,
          "value"=>$this->getPresetData('content-posts-three-title'),
          "min"=>1,
          "error"=>"Le champ #posts-1-title ne peut pas être vide",
        ],
        "content-posts-three-text"=>[
          "type"=>"text",
          "placeholder"=>"Entrer le contenu du #posts-1-text",
          "required"=>true,
          "id"=>"input-content-posts-three-text",
          "class"=>null,
          "value"=>$this->getPresetData('content-posts-three-text'),
          "min"=>1,
          "error"=>"Le champ #posts-1-text ne peut pas être vide",
        ],
      ],
      3=>[
        "content-video-videoTitle"=>[
          "type"=>"text",
          "placeholder"=>"Entrer le titre de votre #video-videoTitle",
          "required"=>true,
          "id"=>"input-content-video-videoTitle",
          "class"=>null,
          "value"=>$this->getPresetData('content-video-videoTitle'),
          "min"=>1,
          "error"=>"Le champ #video-videoTitle ne peut pas être vide",
        ],
        "content-video-videoSrc"=>[
          "type"=>"url",
          "placeholder"=>"Entrer l'url de votre vidéo youtube #video-videoSrc",
          "required"=>true,
          "id"=>"input-content-video-videoSrc",
          "class"=>null,
          "value"=>$this->getPresetData('content-video-videoSrc'),
          "min"=>1,
          "error"=>"Le champ #video-videoSrc ne peut pas être vide",
        ],

        "content-article-articleTitle"=>[
          "type"=>"text",
          "placeholder"=>"Entrer le titre de votre #article-articleTitle",
          "required"=>true,
          "id"=>"input-content-article-articleTitle",
          "class"=>null,
          "value"=>$this->getPresetData('content-article-articleTitle'),
          "min"=>1,
          "error"=>"Le champ #article-articleTitle ne peut pas être vide",
        ],
        "content-article-articleText"=>[
          "type"=>"text",
          "placeholder"=>"Entrer le texte de votre #article-articleText",
          "required"=>true,
          "id"=>"input-content-article-articleText",
          "class"=>null,
          "value"=>$this->getPresetData('content-article-articleText'),
          "min"=>1,
          "error"=>"Le champ #article-articleText ne peut pas être vide",
        ],
        "content-article-articleBackgroundColor"=>[
          "type"=>"color",
          "placeholder"=>"Entrer la couleur de fond de votre article #article-articleBackgroundColor",
          "required"=>true,
          "id"=>"input-content-article-articleBackgroundColor",
          "class"=>null,
          "value"=>$this->getPresetData('content-article-articleBackgroundColor'),
          "min"=>1,
          "error"=>"Le champ #article-articleBackgroundColor ne peut pas être vide",
        ],

        "content-wysiwyg-content"=>[
          "type"=>"wysiwyg",
          "placeholder"=>"Entrer le contenu de votre wysiwyg #wysiwyg-content",
          "required"=>true,
          "id"=>"input-content-wysiwyg-content",
          "class"=>null,
          "value"=>$this->getPresetData('content-wysiwyg-content'),
          "min"=>1,
          "error"=>"Le champ #wysiwyg-content ne peut pas être vide",
        ],
      ]
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
      "inputs"=>array_merge($this->getConfigInputs(), $this->getHeaderInputs(), $this->themes[$selectedTheme], $this->getFooterInputs())
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

  private function getConfigInputs(): array
  {
    return [
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
      ]
    ];
  }

  private function getHeaderInputs(): array
  {
    return [
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
    ];
  }

  private function getFooterInputs(): array
  {
    return [
      "content-footer-companyTitle"=>[
        "type"=>"text",
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
    ];
  }
}