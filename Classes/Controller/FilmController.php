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

    public function index()
    {
        $this->view->assign('testkey', 'testdata');
        $this->view->render('<h1>index</h1>');
    }

    public function testFunctionAction()
    {
        $this->view->render('testFunction');
    }
}