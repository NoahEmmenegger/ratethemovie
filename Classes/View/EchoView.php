<?php

namespace NoahEmmenegger\RateTheMovie\View;

class EchoView {

    protected $data = [];

    public function render($output)
    {
        require(__DIR__. "/template/register.php");
        echo $output;
    }

    public function assign($key, $data)
    {
        $this->data[$key] = $data;
    }
}

?>

<html>
    <head>
        test
    </head>
    <body>
        <h1>template</h1>
    </body>
</html>