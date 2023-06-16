<?php
    namespace App\controllers;
    use App\core\View;

final class DesignTestController {

    public $dataSlideshow = [
        ["imgSrc"=>"https://hatrabbits.com/wp-content/uploads/2017/01/random.jpg", "imgAlt"=>"description of the first picture"],
        ["imgSrc"=>"https://www.doubledtrailers.com/assets/images/random%20horse%20facts%20shareable.png", "imgAlt"=>"description of the second picture"],
        ["imgSrc"=>"https://fs-prod-cdn.nintendo-europe.com/media/images/10_share_images/games_15/nintendo_switch_download_software_1/H2x1_NSwitchDS_LostInRandom_image1600w.jpg", "imgAlt"=>"description of the third picture"],
    ];

    public $dataCustomCard = [
        ["imgSrc"=> "https://api.iconify.design/material-symbols:house-outline.svg", "imgAlt"=>"description of the first picture", "title"=>"Heading1", "p"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."],
        ["imgSrc"=> "https://api.iconify.design/material-symbols:house-outline.svg", "imgAlt"=>"description of the second picture", "title"=>"Heading2", "p"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."],
        ["imgSrc"=> "https://api.iconify.design/material-symbols:house-outline.svg", "imgAlt"=>"description of the third picture", "title"=>"Heading3", "p"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua."]
    ];

    public $dataQuote = [
        "quote"=>"I love this landing page template! It rocks!",
        "author"=>"Jean",
        "info"=>"Toto Company",
    ];

    public $dataBanner = [
        "companyTitle"=>"toto",
        "imgSrc"=>'https://external-content.duckduckgo.com/iu/?u=https%3A%2F%2Ftse1.mm.bing.net%2Fth%3Fid%3DOIP.zO7A4uwcxSoxC_Idg99ygQHaCv%26pid%3DApi&f=1&ipt=b5f83dd2531296f3042d63a8c1eb239be4102b3b033236e09a62ef310a23f171&ipo=images'
    ];

    public $dataFooter = [
        "companyTitle"=>"Toto",
        "footerColor"=>"#f6b73c"
    ];

    public function displayWireframe1()
    {
        $view = new View('wireframe1', 'front');
        $view->assign('dataFooter', $this->dataFooter);
        $view->assign('dataBanner', $this->dataBanner);
        $view->assign('dataSlideshow', $this->dataSlideshow);
        $view->assign('dataCustomcard', $this->dataCustomCard);
        $view->assign('dataQuote', $this->dataQuote);
        
    }
}