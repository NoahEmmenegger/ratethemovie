<?php

namespace NoahEmmenegger\RateTheMovie\Service;

use \NoahEmmenegger\RateTheMovie\View\EchoView;
use PDO;

class FilmService {
    public function GetFilmByName($name)
    {
        $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
        $sql = "SELECT * FROM `film` WHERE `titel`LIKE '$name'";
        $result = $con->query($sql);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function GetKommentare($filmId)
    {
        $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
        $sql = "SELECT kommentar.Inhalt, user.Vorname, user.Nachname, bewertung.AnzahlSterne
         FROM `kommentar` 
         INNER JOIN `user` ON kommentar.UserId = user.Id
         LEFT JOIN `bewertung` ON user.Id = bewertung.UserId
         WHERE kommentar.FilmId LIKE '$filmId' AND bewertung.FilmId LIKE '$filmId' OR bewertung.FilmId IS NULL";
        $result = $con->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function AddKommentar($inhalt, $userId, $filmId)
    {
        $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
        $sql = "INSERT INTO kommentar (Inhalt, UserId, FilmId) VALUES ('$inhalt', '$userId', '$filmId')";
        $result = $con->query($sql);
    }

    public function GetBewertung($filmId)
    {
        $userId  = $_COOKIE['userid'];
        $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
        $sql = "SELECT * FROM `bewertung` WHERE `filmId`LIKE '$filmId' AND `userId` LIKE '$userId'";
        $result = $con->query($sql);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    public function GetBewertungen($filmId)
    {
        $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
        $sql = "SELECT * FROM `bewertung` WHERE `filmId`LIKE '$filmId'";
        $result = $con->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function AddBewertung($AnzahlSterne, $userId, $filmId)
    {
        if(!$this->GetBewertung($filmId))
        {
            $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
            $sql = "INSERT INTO bewertung (AnzahlSterne, UserId, FilmId) VALUES ('$AnzahlSterne', '$userId', '$filmId')";
            $result = $con->query($sql);
        }else {
            $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
            $sql = "UPDATE bewertung SET AnzahlSterne = '$AnzahlSterne' WHERE `filmId`LIKE '$filmId' AND `userId` LIKE '$userId'";
            $result = $con->query($sql);
        }
    }
}