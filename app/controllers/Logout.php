<?php

class Logout
{
    use Controller;
    public function index(){
        
        if(isset($_SESSION)){
            if (is_logged_in()){
                $user = new User();
                $row = $user->first(['id'=>$_SESSION['id']]);
                $user->delete_remember_token($row['id']);
            }
            clear_remember_me();
            logout_user();
            redirect('login');
        }
    }
}
