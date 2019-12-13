<?php

namespace NoahEmmenegger\RateTheMovie\Controller;

include_once(__DIR__.'/../View/EchoView.php');

use \NoahEmmenegger\RateTheMovie\View\EchoView;


class FilmController {

    protected $view = null;

    public function __construct()
    {
        $this->view = new EchoView();
    }

    public function testFunctionAction()
    {
        $this->view->render('testttes');
    }
}