<?php

class Doctor
{
    use Controller;
    function index()
    {
        $this->dashboard();
    }
    
    public function dashboard()
    {
        require_login();
        
        $user = get_user();
        
        if ($user->role != 'doctor') {
            redirect('login');
        }
        $this->view('doctor/dashboard');
    }
    public function manage_appointments()
    {
        require_login();
        
        $user = get_user();
        
        if ($user->role != 'doctor') {
            redirect('login');
        }
        $this->view('doctor/manage_appointments');
    }
}