<?php
defined('ROOTPATH') OR exit('Access Denied! 403 Forbidden!');

class Medicines
{
    use Controller;

    public function index(){
        $this->view('medicines');
    }
}
?>