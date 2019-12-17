<?php
//url auslesen

//switch case


use NoahEmmenegger\RateTheMovie\Controller\FilmController;

include_once('Classes/Controller/FilmController.php');

echo str_replace('/ratethemovie/', '', $_SERVER['REQUEST_URI']);

switch (str_replace('/ratethemovie/', '', $_SERVER['REQUEST_URI'])) {
    case '' :
        $filmController = new FilmController();
        $filmController->index();
        break;
    case 'index.php' :
        $filmController = new FilmController();
        $filmController->index();
        break;
    case 'about.php' :
        $filmController = new FilmController();
        $filmController->testFunctionAction();
        break;
    default:
        http_response_code(404);
        $filmController = new FilmController();
        $filmController->testFunctionAction();
        break;
}



//controller action aufrufen