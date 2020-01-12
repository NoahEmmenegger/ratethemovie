<?php

namespace NoahEmmenegger\RateTheMovie\Service;

use \NoahEmmenegger\RateTheMovie\View\EchoView;
use PDO;

class AccountService {
    // erstelle einen Account
    public function CreateAccount($vorname, $nachname, $email, $psw)
    {
        // schaut, ob email valid ist
        if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            echo('geben Sie eine gültige Email ein');
            return;
        }
        if($this->GetUserByEmail($email)->rowCount() == 0)
        {
            $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
            $sql = "INSERT INTO User (Vorname, Nachname, Email, Passwort) VALUES ('$vorname', '$nachname', '$email', '$psw')";
            $result = $con->query($sql);
        }
    }

    // erhalte den user, anhand der email
    public function GetUserByEmail($email)
    {
        $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
        $sql = "SELECT * FROM `user` WHERE `email`LIKE '$email'";
        $result = $con->query($sql);
        return $result;
    }

    // erhalte die userid anhand der email
    public function GetUserIdByEmail($email)
    {
        $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
        $sql = "SELECT `Id` FROM `user` WHERE `email`LIKE '$email'";
        $result = $con->query($sql);
        return $result->fetch(PDO::FETCH_ASSOC)['Id'];
    }

    // einloggen
    public function Login($email, $passwort)
    {
        $userraw = $this->GetUserByEmail($email);
        // wenn ein user gefunden wurde
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