<?php

namespace NoahEmmenegger\RateTheMovie\Service;

use \NoahEmmenegger\RateTheMovie\View\EchoView;
use PDO;

class FilmService {
    // erhalte die 3 beliebtesten Filme
    public function GetFilmsSortByRate()
    {
        $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
        $sql = "SELECT  *
        FROM    (
                SELECT  f.Titel, f.Bild, AVG(b.AnzahlSterne) AS ar, COUNT(*) AS cnt
                FROM    film f
                JOIN    bewertung b
                ON      b.FilmId = f.Id
                GROUP BY
                        f.Id
                ) q
        ORDER BY
                CASE WHEN cnt >= 100 THEN 0 ELSE 1 END, ar DESC";
        $result = $con->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // erhalte Film anhand dem Namen
    public function GetFilmByName($name)
    {
        $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
        $sql = "SELECT * FROM `film` WHERE `titel`LIKE '$name'";
        $result = $con->query($sql);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    // suche ein Film
    public function SearchFilms($search)
    {
        $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
        $sql = "SELECT * FROM film WHERE `Titel` LIKE '%$search%'";
        $result = $con->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // erhalte alle Kommentare eines Filmes
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

    // füge ein Kommentar dem Film hinzu
    public function AddKommentar($inhalt, $userId, $filmId)
    {
        $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
        $sql = "INSERT INTO kommentar (Inhalt, UserId, FilmId) VALUES ('$inhalt', '$userId', '$filmId')";
        $result = $con->query($sql);
    }

    // erhalte alle Bewertungen eines Filmes eines Users
    public function GetBewertung($filmId)
    {
        $userId  = $_COOKIE['userid'];
        $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
        $sql = "SELECT * FROM `bewertung` WHERE `filmId`LIKE '$filmId' AND `userId` LIKE '$userId'";
        $result = $con->query($sql);
        return $result->fetch(PDO::FETCH_ASSOC);
    }

    // erhalte alle Bewertungen eines Filmes
    public function GetBewertungen($filmId)
    {
        $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
        $sql = "SELECT * FROM `bewertung` WHERE `filmId`LIKE '$filmId'";
        $result = $con->query($sql);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    // erhalte anzahl Sterne eines Filmes
    public function GetAnzahlSterne($filmId)
    {
        $anzahlSterne = 0;
        $count = 0;
        // für jede Bewertung
        foreach ($this->GetBewertungen($filmId) as $bewertung)
        {
            $anzahlSterne += $bewertung['AnzahlSterne'];
            $count ++;
        }
        if ($count == 0)
        {
            return;
        }
        // durchschnitt berechnen
        return $anzahlSterne / $count;
    }

    // Bewertung hinzufügen
    public function AddBewertung($AnzahlSterne, $userId, $filmId)
    {
        // falls diese Bewertung noch nicht existiert, erstellt er eine neue Bewertung
        if(!$this->GetBewertung($filmId))
        {
            $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
            $sql = "INSERT INTO bewertung (AnzahlSterne, UserId, FilmId) VALUES ('$AnzahlSterne', '$userId', '$filmId')";
            $result = $con->query($sql);
        }else {
            // falls die Bewertung bereits existiert, überschreibt er die Bewertung
            $con = new PDO('mysql:host=localhost;dbname=ratethemovie', 'root');
            $sql = "UPDATE bewertung SET AnzahlSterne = '$AnzahlSterne' WHERE `filmId`LIKE '$filmId' AND `userId` LIKE '$userId'";
            $result = $con->query($sql);
        }
    }
}