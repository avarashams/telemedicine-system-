<?php
defined('ROOTPATH') OR exit('Access Denied! 403 Forbidden!');

class Lab_tests
{
    use Controller;

    public function index(){
        $this->view('lab_tests');
    }
}
?>