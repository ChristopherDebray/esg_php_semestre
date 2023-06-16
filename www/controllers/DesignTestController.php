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

    public $dataPost = [
        ["imgSrc"=>"https://placehold.co/400x400",
        "imgAlt"=>"Description of the picture",
        "title"=>"Heading",
        "text"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."],
        ["imgSrc"=>"https://placehold.co/400x400",
        "imgAlt"=>"Description of the picture",
        "title"=>"Heading",
        "text"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."],
        ["imgSrc"=>"https://placehold.co/400x400",
        "imgAlt"=>"Description of the picture",
        "title"=>"Heading",
        "text"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."],
    ];

    public $dataArticle = [
        "title"=>"Heading",
        "text"=>"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
        "backgroundColor"=>"grey"
    ];

    public $dataVideo = [
        "title"=>"Heading",
        "videoSrc"=>"https://www.youtube.com/embed/-7mOz1bINz0"
    ];

    public $dataWysiwyg = "<h1> What you see What you get!</h1>";

    public function displayWireframe1()
    {
        $view = new View('wireframe1', 'front');
        $view->assign('dataFooter', $this->dataFooter);
        $view->assign('dataBanner', $this->dataBanner);
        $view->assign('dataSlideshow', $this->dataSlideshow);
        $view->assign('dataCustomcard', $this->dataCustomCard);
        $view->assign('dataQuote', $this->dataQuote);
        $view->assign('dataPost', $this->dataPost);
        
    }

    public function displayWireframe2()
    {
        $view = new View('wireframe2', 'front');
        $view->assign('dataFooter', $this->dataFooter);
        $view->assign('dataBanner', $this->dataBanner);
        $view->assign('dataPost', $this->dataPost);
    }

    public function displayWireframe3()
    {
        $view = new View('wireframe3', 'front');
        $view->assign('dataFooter', $this->dataFooter);
        $view->assign('dataBanner', $this->dataBanner);
        $view->assign('dataArticle', $this->dataArticle);
        $view->assign('dataVideo', $this->dataVideo);
        $view->assign('dataWysiwyg', $this->dataWysiwyg);
    }
}