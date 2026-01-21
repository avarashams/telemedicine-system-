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

function is_nav_active($path)
{
    $current = $_GET['url'] ?? 'home';
    return strpos($current, $path) === 0 ? 'active' : '';
}

function validate_core_doctor($data)
{
    $errors = [];
    // validate d_reg_no
    $d_reg_no = trim($data['d_reg_no'] ?? '');
    if (empty($d_reg_no)) {
        $errors['d_reg_no'] = "Registration number is required.";
    } elseif (!preg_match('/^\d{16}$/', $d_reg_no)) {
        $errors['d_reg_no'] = "Must be 16 digits";
    }
    // validate firstname 
    $d_first_name = trim($data['d_first_name'] ?? '');
    if (!empty($d_first_name)) {
        if (!preg_match('/^[a-zA-Z]+$/', $d_first_name)) {
            $errors['d_first_name'] = "First name can only contain letters.";
        }
        if (strlen($d_first_name) < 2 || strlen($d_first_name) > 30) {
            $errors['d_first_name'] = "First name must be between 2 and 30 characters.";
        }
    } else {
        $errors['d_first_name'] = "First name is required.";
    }
    //validate lastname
    $d_last_name = trim($data['d_last_name'] ?? '');
    if (!empty($d_last_name)) {
        if (!preg_match('/^[a-zA-Z]+$/', $d_last_name)) {
            $errors['d_last_name'] = "First name can only contain letters.";
        }
        if (strlen($d_last_name) < 2 || strlen($d_last_name) > 30) {
            $errors['d_last_name'] = "First name must be between 2 and 30 characters.";
        }
    } else {
        $errors['d_last_name'] = "Last name is required.";
    }
    // title validation
    $d_title = trim($data['d_title'] ?? '');
    if (empty($d_title)) {
        $errors['d_title'] = "Title is required.";
    } elseif (!preg_match('/^[a-zA-Z]+\.?$/', $d_title)) {
        $errors['d_title'] = "Title can only contain letters and an optional dot.";
    }
    //birthdate validation
    $d_birth_date = trim($data['d_birth_date'] ?? '');
    if (empty($d_birth_date)) {
        $errors['d_birth_date'] = "Birthday is required.";
    } elseif (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $d_birth_date)) {
        $errors['d_birth_date'] = "Invalid date format. Use YYYY-MM-DD.";
    } else {
        $date_parts = explode('-', $d_birth_date);
        if (!checkdate($date_parts[1], $date_parts[2], $date_parts[0])) {
            $errors['d_birth_date'] = "Invalid date.";
        }
    }
    //validate gender
    $d_gender = trim($data['d_gender'] ?? '');
    if (empty($d_gender)) {
        $errors['d_gender'] = "Gender is required.";
    }
    // validate email
    $d_email = trim($data['d_email'] ?? '');
    if (empty($d_email)) {
        $errors['d_email'] = "Email is required.";
    } elseif (!filter_var($d_email, FILTER_VALIDATE_EMAIL)) {
        $errors['d_email'] = "Invalid email format.";
    }
    // validate password
    $d_password = trim($data['d_password'] ?? '');
    if (empty($d_password)) {
        $errors['d_password'] = "Password is required.";
    } elseif (strlen($d_password) < 8) {
        $errors['d_password'] = "Password must be at least 8 characters long.";
    } elseif (!preg_match('/[A-Z]/', $d_password)) {
        $errors['d_password'] = "Password must contain at least one uppercase letter.";
    } elseif (!preg_match('/[a-z]/', $d_password)) {
        $errors['d_password'] = "Password must contain at least one lowercase letter.";
    } elseif (!preg_match('/\d/', $d_password)) {
        $errors['d_password'] = "Password must contain at least one digit.";
    } elseif (!preg_match('/[\W_]/', $d_password)) {
        $errors['d_password'] = "Password must contain at least one special character.";
    }
    // validate specialty other than select
    $d_specialty = trim($data['d_specialty'] ?? '');
    if (empty($d_specialty) || $d_specialty == 'select') {
        $errors['d_specialty'] = "Specialty is required.";
    }
    // validate phone no
    $d_phone_no = trim($data['d_phone_no'] ?? '');
    if (empty($d_phone_no)) {
        $errors['d_phone_no'] = "Phone number is required.";
    } elseif (!preg_match('/^[1-9]\d{9}$/', $d_phone_no)) {
        $errors['d_phone_no'] = "Invalid phone number format.";
    }
    //date cannot be future date
    $current_date = date('Y-m-d');
    $d_avail_from = trim($data['d_avail_from'] ?? '');
    $d_avail_to = trim($data['d_avail_to'] ?? '');
    if (!empty($d_avail_from) && !empty($d_avail_to)) {
        if ($d_avail_from > $d_avail_to) {
            $errors['d_avail_to'] = "Availability 'to' date cannot be earlier than 'from' date.";
        }
    }
    if (!empty($d_avail_from)) {
        if ($d_avail_from < $current_date) {
            $errors['d_avail_from'] = "Availability 'from' date cannot be a past date.";
        }
    }
    if (!empty($d_avail_to)) {
        if ($d_avail_to < $current_date) {
            $errors['d_avail_to'] = "Availability 'to' date cannot be a past date.";
        }
    }
    // validate availability status
    $d_avail_status = trim($data['d_avail_status'] ?? '');
    if (empty($d_avail_status)) {
        $errors['d_avail_status'] = "Availability status is required.";
    }
    // validate fee
    $d_fee = trim($data['d_fee'] ?? '');
    if (empty($d_fee)) {
        $errors['d_fee'] = "Consultation fee is required.";
    } elseif (!is_numeric($d_fee) || $d_fee < 0) {
        $errors['d_fee'] = "Consultation fee must be a non-negative number.";
    }
    // validate rating
    $d_rating = trim($data['d_rating'] ?? '');
    if (empty($d_rating)) {
        $errors['d_rating'] = "Rating is required.";
    } elseif (!is_numeric($d_rating) || $d_rating < 0 || $d_rating > 5) {
        $errors['d_rating'] = "Rating must be a number between 0 and 5.";
    }
    // store after validation
//        if (empty($errors)) {
//        }
    $_POST['d_reg_no'] = $d_reg_no;
    $_POST['d_first_name'] = ucfirst($d_first_name);
    $_POST['d_last_name'] = ucfirst($d_last_name);
    $_POST['d_title'] = ucfirst($d_title);
    $_POST['d_birth_date'] = $d_birth_date;
    $_POST['d_gender'] = $d_gender;
    $_POST['d_email'] = strtolower($d_email);
    $_POST['d_password'] = password_hash($d_password, PASSWORD_BCRYPT);
    $_POST['d_specialty'] = $d_specialty;
    $_POST['d_phone_no'] = "+880" . $d_phone_no;
    $_POST['d_avail_from'] = $d_avail_from;
    $_POST['d_avail_to'] = $d_avail_to;
    $_POST['d_avail_status'] = $d_avail_status;
    $_POST['d_fee'] = $d_fee;
    $_POST['d_rating'] = $d_rating;
//         show($_POST);
//        print_r();
    return $errors;
}
function validate_core_patient($data)
{
    // write here similar to validate_core_doctor but for patient values
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
            'role' => $_SESSION['role'],
            'd_reg_no' => $_SESSION['d_reg_no' ] ?? null,
            'p_nid_no' => $_SESSION['p_nid_no' ] ?? null
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
            redirect('adminPortal/dashboard');
            break;
        case 'doctor':
            redirect('doctorPortal/dashboard');
            break;
        case 'patient':
            redirect('patientPortal/dashboard');
            break;
        default:
            redirect('home');
    }
}