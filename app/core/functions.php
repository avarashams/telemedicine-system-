<?php

function show($stuff)
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

function esc($str)
{
    // Escape HTML special characters in a string to prevent XSS attacks
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function redirect($path)
{
    // Redirect to a different URL
    header("Location: " . ROOT . "/" . $path);
    die;
}

function init_session()
{
    if (!isset($_SESSION)) {
        session_start();
    }
}
function is_nav_active($path){
    $current = $_GET['url'] ?? 'home';
    return strpos($current, $path) === 0 ? 'active' : '';
}

function generate_token($length = 64)
{
    return bin2hex(random_bytes($length / 2));
}

function set_remember_me($userId, $token, $days = 30)
{
    $cookieValue = $userId . ':' . $token;
    $expiry = time() + $days * 24 * 60 * 60;

    setcookie(
        'remember-me',
        $cookieValue,
        $expiry,
        '/',
    );
}

function get_remember_me()
{
    if (isset($_COOKIE['remember-me'])) {
        $parts = explode(':', $_COOKIE['remember-me']);

        if (count($parts) === 2) {
            return [
                'userId' => $parts[0],
                'token' => $parts[1]
            ];
        }
    }
    return null;
}

function clear_remember_me()
{
    if (isset($_COOKIE['remember-me'])) {
        setcookie('remember-me', '', time() - 3600, '/');
        unset($_COOKIE['remember-me']);
    }
}

function check_remember_me()
{
    $cookie = get_remember_me();
//    var_dump($cookie);
    if ($cookie) {
        $user = new User();
        $row = $user->first(['remember_token' => $cookie['token']]);
//        var_dump($row);
        if ($row) {
//            login_user($row);
            
            return true;
        } else {
            clear_remember_me();
        }
    }
    return false;
}

function is_logged_in()
{
    init_session();
    return isset($_SESSION['id']);
    
}

function get_user()
{
    init_session();
    if (is_logged_in()) {
        return (object)[
            'id' => $_SESSION['id'],
            'email' => $_SESSION['email'],
            'role' => $_SESSION['role']
        ];
    }
    return null;
}

function has_role()
{
    init_session();
    if (is_logged_in()) {
        return $_SESSION['role'] ?? null;
    }
    return false;
}

function require_login()
{

    if (!is_logged_in()) {
        redirect('/login');
    }
}

function require_role($role, $redirect = '/login')
{
    require_login($redirect);

    if (!has_role($role)) {
        // Redirect to unauthorized page or their appropriate dashboard
        redirect('/unauthorized');
    }
}

function login_user($user)
{
    init_session();
    $_SESSION['id'] = $user['id'];
    $_SESSION['email'] = $user['email'];
    $_SESSION['role'] = $user['role'];
    redirect_by_role($_SESSION['role']);
    session_regenerate_id(true); // Prevent session fixation attacks
}

function logout_user()
{
    init_session();
    // Unset all session variables
    $_SESSION = [];
    // Destroy the session
    session_destroy();
}

function redirect_by_role($role)
{
    switch ($role) {
        case 'admin':
            redirect('admin/dashboard');
            break;
        case 'doctor':
            redirect('doctor/dashboard');
            break;
        case 'patient':
            redirect('patient/dashboard');
            break;
        default:
            redirect('home');
    }
}