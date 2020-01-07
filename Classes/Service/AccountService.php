<?php

namespace NoahEmmenegger\RateTheMovie\Service;

use \NoahEmmenegger\RateTheMovie\View\EchoView;
use PDO;

class AccountService {
    public function CreateAccount($vorname, $nachname, $email, $psw)
    {
        if(!$this->GetUserByEmail($email))
        {
            $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
            $sql = "INSERT INTO User (Vorname, Nachname, Email) VALUES ('$vorname', '$nachname', '$email')";
            $result = $con->query($sql);
        }
    }

    public function GetUserByEmail($email)
    {
        $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
        $sql = "SELECT * FROM `user` WHERE `email`LIKE '$email'";
        $result = $con->query($sql);
        var_dump($result);
        return $result;
    }
}