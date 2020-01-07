<?php

namespace NoahEmmenegger\RateTheMovie\View;

class EchoView {

    protected $data = [];

    public function render($phpFileName)
    {
        require(__DIR__. "/template//". $phpFileName .".php");
    }

    public function assign($key, $data)
    {
        $this->data[$key] = $data;
    }
}

?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="/ratethemovie/vorlagen/style.css">
    </head>
    <body>
       <header>
       <ul>
            <li><a href="/ratethemovie/login">Login</a></li>
            <li><a href="/ratethemovie/register">Register</a></li>
        </ul>
       </header>
    </body>
</html>