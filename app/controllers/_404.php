<?php

class _404 
{
    use Controller;
    
    public function index()
    {
        var_dump($_SESSION);
        var_dump($_REQUEST);
        $this->view('404');
    }
}