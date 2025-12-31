<?php

trait Controller
{
    public function view($name, $data = [])
    {
        if (is_array($data)) {
            extract($data);
        }
        
        $filename = "../app/views/" . $name . ".view.php";
//        var_dump($filename);
//        var_dump($_SESSION);
        

        var_dump($_COOKIE);
        var_dump($filename);
        if (file_exists($filename)) {
            require_once $filename;
        } else {
            $filename = "../app/views/404.view.php";
            require_once $filename;
        }
    }
}