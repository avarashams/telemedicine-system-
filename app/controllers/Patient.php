<?php

class Patient
{
    use Controller;
    function index()
    {
        $this->dashboard();
    }
    
    public function dashboard(){
        require_login();
        $user = get_user();
        
        if ($user->role != 'patient') {
            redirect('login');
        }
        $this->view('patient/dashboard');
    }
}