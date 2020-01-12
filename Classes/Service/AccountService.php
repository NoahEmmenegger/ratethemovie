<?php

namespace NoahEmmenegger\RateTheMovie\Service;

use \NoahEmmenegger\RateTheMovie\View\EchoView;
use PDO;

class AccountService {
    public function CreateAccount($vorname, $nachname, $email, $psw)
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            echo('geben Sie eine gültige Email ein');
        }
        if($this->GetUserByEmail($email)->rowCount() == 0)
        {
            $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
            $sql = "INSERT INTO User (Vorname, Nachname, Email, Passwort) VALUES ('$vorname', '$nachname', '$email', '$psw')";
            $result = $con->query($sql);
        }
    }

    public function GetUserByEmail($email)
    {
        $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
        $sql = "SELECT * FROM `user` WHERE `email`LIKE '$email'";
        $result = $con->query($sql);
        return $result;
    }

    public function GetUserIdByEmail($email)
    {
        $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
        $sql = "SELECT `Id` FROM `user` WHERE `email`LIKE '$email'";
        $result = $con->query($sql);
        return $result->fetch(PDO::FETCH_ASSOC)['Id'];
    }

    public function Login($email, $passwort)
    {
        $userraw = $this->GetUserByEmail($email);
        if ($userraw->rowCount() != 0)
        {
            $userfetch = $userraw->fetch(PDO::FETCH_ASSOC);
            if($userfetch['Passwort'] == $passwort)
            {
                setcookie("userid", $userfetch['Id'],0);
            }
        }
    }

}