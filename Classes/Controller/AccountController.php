<?php

namespace NoahEmmenegger\RateTheMovie\Controller;

include_once(__DIR__.'/../View/EchoView.php');
include_once('Classes/Service/AccountService.php');

use NoahEmmenegger\RateTheMovie\Service\AccountService;
use \NoahEmmenegger\RateTheMovie\View\EchoView;


class AccountController {

    protected $view = null;

    public function __construct()
    {
        $this->view = new EchoView();
    }

    public function registerAction()
    {
        if (isset($_POST['vorname']) && isset($_POST['nachname']) && isset($_POST['email']) && isset($_POST['psw']))
        {
            $accountService = new AccountService();
            $accountService->CreateAccount($_POST['vorname'], $_POST['nachname'], $_POST['email'], $_POST['psw']);

            setcookie("userid", $accountService->GetUserIdByEmail($_POST['email']) ,0);
            header("Location: http://localhost/ratethemovie");
            die();
        }
        $this->view->render('register');
    }

    public function loginAction()
    {
        if (isset($_POST['email']) && isset($_POST['psw']))
        {
            $accountService = new AccountService();
            $accountService->Login($_POST['email'], $_POST['psw']);
            header("Location: http://localhost/ratethemovie");
            die();
        }else {
            $this->view->render('login');
        }
    }

    public function logoutAction()
    {
        setcookie('userid', '', time() - 3600);
        header("Location: http://localhost/ratethemovie");
        die();
    }
}