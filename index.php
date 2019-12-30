<?php

use NoahEmmenegger\RateTheMovie\Controller\FilmController;

include_once('Classes/Controller/FilmController.php');

$explode = explode('/', $_SERVER['REQUEST_URI']);
$filmName = array_splice($explode, -1)[0];

switch (str_replace('/ratethemovie/', '', $_SERVER['REQUEST_URI'])) {
    case '' :
        $filmController = new FilmController();
        $filmController->index();
        break;
    case 'index' :
        $filmController = new FilmController();
        $filmController->index();
        break;
    case 'detail/' . $filmName :
        $filmController = new FilmController();
        $filmController->detail($filmName);
        break;
    case 'register' :
        $filmController = new FilmController();
        $filmController->testFunctionAction();
        break;
    default:
        http_response_code(404);
        $filmController = new FilmController();
        $filmController->testFunctionAction();
        break;
}