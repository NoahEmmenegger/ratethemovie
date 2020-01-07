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
        if ($_POST['vorname'] && $_POST['nachname'] && $_POST['email'] && $_POST['psw'])
        {
            $accountService = new AccountService();
            $accountService->CreateAccount($_POST['vorname'], $_POST['nachname'], $_POST['email'], $_POST['psw']);

            session_start();
            $_SESSION['userid'] = $accountService->GetUserIdByEmail($_POST['email']);
        }
        $this->view->render('register');
    }

    public function loginAction()
    {
        if ($_POST['email' && $_POST['passwort']])
        {
            $accountService = new AccountService();
            $accountService->Login($_POST['email'], $_POST['passwort']);
        }
        $this->view->render('login');
    }
}