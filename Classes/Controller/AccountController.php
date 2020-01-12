<?php

namespace NoahEmmenegger\RateTheMovie\Controller;

include_once(__DIR__.'/../View/EchoView.php');
include_once('Classes/Service/AccountService.php');

use NoahEmmenegger\RateTheMovie\Service\AccountService;
use \NoahEmmenegger\RateTheMovie\View\EchoView;


class AccountController {

    protected $view = null;

    // constructor
    public function __construct()
    {
        // inject
        $this->view = new EchoView();
    }

    // neuer User registrieren
    public function registerAction()
    {
        // Wenn vorname, nachname, email und passwort gesetzt ist, erstelle ein neuen user
        if (isset($_POST['vorname']) && isset($_POST['nachname']) && isset($_POST['email']) && isset($_POST['psw']))
        {
            $accountService = new AccountService();
            $accountService->CreateAccount($_POST['vorname'], $_POST['nachname'], $_POST['email'], $_POST['psw']);

            // damit der neue User direkt eingeloggt ist
            setcookie("userid", $accountService->GetUserIdByEmail($_POST['email']) ,0);
            // weiterleitung zum home
            header("Location: http://localhost/ratethemovie");
            die();
        }
        $this->view->render('register');
    }

    // einlogggen
    public function loginAction()
    {
        // wenn email und passwort gesetzt ist, einloggen
        if (isset($_POST['email']) && isset($_POST['psw']))
        {
            $accountService = new AccountService();
            $accountService->Login($_POST['email'], $_POST['psw']);
            // weiterleitung zum home
            header("Location: http://localhost/ratethemovie");
            die();
        }else {
            $this->view->render('login');
        }
    }

    // ausloggen
    public function logoutAction()
    {
        // cookie löschen
        setcookie('userid', '', time() - 3600);
        header("Location: http://localhost/ratethemovie");
        die();
    }
}