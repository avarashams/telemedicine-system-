<?php

class Login
{
    use Controller;

    public function index()
    {

//        check_remember_me();

        $errors = [];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $user = new User();
            $arr['email'] = $_POST['email'];
            $arr['password'] = $_POST['password'];
            $row = $user->first($arr);
            show($row);
            if ($row) {
                if ($row['password'] === $_POST['password']) {
                    init_session();
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['password'] = $row['password'];
                    $_SESSION['role'] = $row['role'];
                    $_SESSION['id'] = $row['id'];
                    if (isset($_POST['remember-me'])) {
//                        $token = generate_token();
//                        $user->save_remember_token($row->id, $token);
//                        set_remember_me($row->id, $token);
                        setcookie('remember-email', $_POST['email'], time() + (86400 * 30), "/"); // 86400 = 1 day
                        setcookie('remember-password', $_POST['password'], time() + (86400 * 30), "/"); // 86400 = 1 day
                    } else{
                        setcookie('remember-email', '', time() - 3600, "/");
                        setcookie('remember-password', '', time() - 3600, "/");
                    }
                    var_dump($_SESSION);
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