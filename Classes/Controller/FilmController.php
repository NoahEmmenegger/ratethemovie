<?php

namespace NoahEmmenegger\RateTheMovie\Controller;

include_once(__DIR__.'/../View/EchoView.php');
include_once('Classes/Service/FilmService.php');

use DateTime;
use NoahEmmenegger\RateTheMovie\Service\FilmService;
use \NoahEmmenegger\RateTheMovie\View\EchoView;


class FilmController {

    protected $view = null;

    // konstruktor
    public function __construct()
    {
        // inject
        $this->view = new EchoView();
    }

    // home seite
    public function index()
    {
        $filmService = new FilmService();
        $this->view->assign('filme', $filmService->GetFilmsSortByRate());
        $this->view->render('index');
    }

    // film detail
    public function detail($filmName)
    {
        $filmService = new FilmService();
        $film = $filmService->GetFilmByName($filmName);
        // neuer kommentar hinzufügen
        if (isset($_POST['kommentar']) && isset($_COOKIE['userid']))
        {
            $filmService->AddKommentar($_POST['kommentar'], $_COOKIE['userid'], $film['Id']);
        }
        // neue bewertung hinzufügens
        if (isset($_POST['bewertung']) && isset($_COOKIE['userid']))
        {
            $filmService->AddBewertung($_POST['bewertung'], $_COOKIE['userid'], $film['Id']);
        }
        // wenn der user eingeloggt ist, soll er seine Bewertung sehen können
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

    // film suche
    public function searchAction()
    {
        $filmService = new FilmService();

        $this->view->assign('searching', $_POST['search']);
        $this->view->assign('filme', $filmService->SearchFilms($_POST['search']));
        $this->view->render('search');
    }
}