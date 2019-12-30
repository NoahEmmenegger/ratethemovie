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
    <body>
    <li><a href="">Register</a></li>
    <li><a href="">Login</a></li>
    </body>
</html>