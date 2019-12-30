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
        $this->view->render('index');
    }

    public function detail($filmName)
    {
        $this->view->assign('filmName', $filmName);
        $this->view->render('detail');
    }

    public function testFunctionAction()
    {
        $this->view->render('register');
    }
}