<?php

namespace NoahEmmenegger\RateTheMovie\Controller;

include_once(__DIR__.'/../View/EchoView.php');
include_once('Classes/Service/FilmService.php');

use DateTime;
use NoahEmmenegger\RateTheMovie\Service\FilmService;
use \NoahEmmenegger\RateTheMovie\View\EchoView;


class FilmController {

    protected $view = null;

    public function __construct()
    {
        $this->view = new EchoView();
    }

    public function index()
    {
        $filmService = new FilmService();
        $this->view->assign('filme', $filmService->GetFilmsSortByRate());
        $this->view->render('index');
    }

    public function detail($filmName)
    {
        $filmService = new FilmService();
        $film = $filmService->GetFilmByName($filmName);
        if (isset($_POST['kommentar']))
        {
            $filmService->AddKommentar($_POST['kommentar'], $_COOKIE['userid'], $film['Id']);
        }
        if (isset($_POST['bewertung']))
        {
            $filmService->AddBewertung($_POST['bewertung'], $_COOKIE['userid'], $film['Id']);
        }
        if (isset($_COOKIE['userid']))
        {
            $this->view->assign('anzahlSterne', $filmService->GetBewertung($film['Id'])['AnzahlSterne']);
        }
        $kommentare = $filmService->GetKommentare($film['Id']);
        $this->view->assign('anzahlSterneFilm', $filmService->GetAnzahlSterne($film['Id']));
        $this->view->assign('film', $film);
        $this->view->assign('kommentare', $kommentare);
        $this->view->render('detail');
    }

    public function testFunctionAction()
    {
        $this->view->render('register');
    }

    public function searchAction()
    {
        $filmService = new FilmService();

        $this->view->assign('searching', $_POST['search']);
        $this->view->assign('filme', $filmService->SearchFilms($_POST['search']));
        $this->view->render('search');
    }
}