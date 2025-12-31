<?php

class App
{
    private $controller = 'Home';
    private $method = 'index';
    
    private function splitURL()
    {
        $url = rtrim($_GET['url'] ?? 'home');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $urlParts = explode('/', trim($url, "/"));
        return $urlParts;
    }

    public function loadController()
    {
        $URL = $this->splitURL();
        var_dump($URL);
        $filename = "../app/controllers/" . ucfirst($URL[0]) . ".php";
        if (file_exists($filename)) {
            require_once $filename;
            $this->controller = ucfirst($URL[0]);
            unset($URL[0]);
        } else {
            $filename = "../app/controllers/_404.php";
            require_once $filename;
            $this->controller = '_404';
        }
//show($filename);

//        show($URL);
        $controller = new $this->controller;
        
        // for dashboard and admin panel
        if(isset($URL[1])){
            if(method_exists($controller, $URL[1])){
                $this->method = $URL[1];
                unset($URL[1]);
            }
        }
        call_user_func_array([$controller, $this->method], []);
    }
}