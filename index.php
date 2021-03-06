<?php

use NoahEmmenegger\RateTheMovie\Controller\AccountController;
use NoahEmmenegger\RateTheMovie\Controller\FilmController;

include_once('Classes/Controller/FilmController.php');
include_once('Classes/Controller/AccountController.php');

// url auslesen
$explode = explode('/', $_SERVER['REQUEST_URI']);
$filmName = array_splice($explode, -1)[0];

// url bearbeiten und zur richtigen Action
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
    case 'search' :
        $filmController = new FilmController();
        $filmController->searchAction($filmName);
        break;
    case 'register' :
        $accountController = new AccountController();
        $accountController->registerAction();
        break;
    case 'login' :
        $accountController = new AccountController();
        $accountController->loginAction();
        break;
    case 'logout' :
        $accountController = new AccountController();
        $accountController->logoutAction();
        break;
    default:
    // falls Url nicht erkannt wird
        http_response_code(404);
        $filmController = new FilmController();
        $filmController->index();
        break;
}