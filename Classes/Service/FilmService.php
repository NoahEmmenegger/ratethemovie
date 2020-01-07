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
}