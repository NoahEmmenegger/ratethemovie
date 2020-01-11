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
           <li style="float:left"><a href="/ratethemovie">Home</a></li>
           <?php 
                if (!isset($_COOKIE['userid']))
                {
           ?>
            <li><a href="/ratethemovie/login">Login</a></li>
            <li><a href="/ratethemovie/register">Register</a></li>
            <?php 
                }
                else {
           ?>
            <li><a href="/ratethemovie/logout">logout</a></li>
            <?php 
                }
           ?>
        </ul>
       </header>
    </body>
</html>