<?php

class Login
{
    use Controller;

    public function index()
    {
        
        check_remember_me();

        $errors = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = new User();
            $arr['email'] = $_POST['email'];
            $row = $user->first($arr);
            
            if ($row) {
                if ($row->password === $_POST['password']) {
                    if (isset($_POST['remember-me'])) {
                        $token = generate_token();
                        $user->save_remember_token($row->id, $token);
                        set_remember_me($row->id, $token);
                    }
                    login_user($row);
//                    redirect_by_role($row->role);
                    // after redirects it dies here, so no code will work after this
                }
            } 
                $user->errors = ["Invalid email or password."];
                $errors = $user->errors;
            
        }
        $this->view('login', ['errors' => $errors]);
    }
}