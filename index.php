<?php
//url auslesen

//switch case


use NoahEmmenegger\RateTheMovie\Controller\FilmController;

include_once('Classes/Controller/FilmController.php');

$filmController = new FilmController();

$filmController->testFunctionAction();



//controller action aufrufen