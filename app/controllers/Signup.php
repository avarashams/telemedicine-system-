<?php

class Signup
{
    use Controller;

    public function index()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            header('Content-Type: application/json');

            $errors = $this->validate($_POST);
            if (!empty($errors)) {
                echo json_encode([
                    'status' => 'error',
                    'errors' => $errors
                ]);
                exit;
            }
//            var_dump($_POST);
//            $user = new User();
//            if ($this->validate()) {
//                redirect('login');
//            }
//            $errors = $user->errors;

            echo json_encode([
                'status' => 'success',
                'message' => 'Form submitted successfully'
            ]);
            $doctor = new Doctor();
//            $doctor->insert($_POST);
            print_r($doctor);
            exit;
            
        }
        $this->view('signup', ['errors' => $errors]);
    }

    public function validate($data)
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
        // validate specialty other than select
        $d_specialty = trim($data['d_specialty'] ?? '');
        if (empty($d_specialty) || $d_specialty == 'select') {
            $errors['d_specialty'] = "Specialty is required.";
        }
        // validate email
        $d_email = trim($data['d_email'] ?? '');
        if (empty($d_email)) {
            $errors['d_email'] = "Email is required.";
        } elseif (!filter_var($d_email, FILTER_VALIDATE_EMAIL)) {
            $errors['d_email'] = "Invalid email format.";
        }
        // validate phone no
        $d_phone_no = trim($data['d_phone_no'] ?? '');
        if (empty($d_phone_no)) {
            $errors['d_phone_no'] = "Phone number is required.";
        } elseif (!preg_match('/^[1-9]\d{9}$/', $d_phone_no)) {
            $errors['d_phone_no'] = "Invalid phone number format.";
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
        // store after validation
//        if (empty($errors)) {
//        }
        $_POST['d_reg_no'] = $d_reg_no;
        $_POST['d_first_name'] = ucfirst($d_first_name);
        $_POST['d_last_name'] = ucfirst($d_last_name);
        $_POST['d_birth_date'] = $d_birth_date;
        $_POST['d_email'] = strtolower($d_email);
        $_POST['d_phone_no'] = "+880" . $d_phone_no;
//        $_POST['d_password'] = password_hash($d_password, PASSWORD_BCRYPT);
        $_POST['d_password'] = $d_password;
//         show($_POST);
//        print_r();
        return $errors;
    }

}