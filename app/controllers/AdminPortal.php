<?php

class AdminPortal
{
    use Controller;

    function index()
    {
//        require_login();
        $this->dashboard();
    }

    public function dashboard()
    {
//        check_remember_me();
        $user = get_user();
        if ($user->role != 'admin') {
            redirect('login');
        }
        $doctor = new Doctor;
        $doctors = $doctor->find_all(100);

        $patient = new Patient;
        $patients = $patient->find_all(100);

        $appointment = new Appointment;
        $appointments = $appointment->find_all(100);
        $data = [
            'user' => $user,
            'title' => 'Admin Dashboard - Telemedicine++',
            'doctors_count' => count($doctors),
            'patients_count' => count($patients),
            'appointments_count' => count($appointments),
        ];
        $this->view('admin/dashboard', $data);
    }

    public function manage_doctors()
    {
        $user = get_user();
        if ($user->role != 'admin') {
            redirect('login');
        }
        $doctor = new Doctor;        

        $doctors = $doctor->find_all();
        $data = [
            'user' => $user,
            'doctors' => $doctors,
            'title' => 'Manage Doctors - Telemedicine++',
        ];

        $this->view('admin/manage_doctors', $data);
    }

    public function add_doctor()
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            header('Content-Type: application/json');
            $doctor = new Doctor();
            $newData = [
                'd_reg_no' => $_POST['d_reg_no'],
                'd_first_name' => $_POST['d_first_name'],
                'd_last_name' => $_POST['d_last_name'],
                'd_title' => $_POST['d_title'],
                'd_birth_date' => $_POST['d_birth_date'],
                'd_gender' => $_POST['d_gender'] ?? '',
                'd_specialty' => $_POST['d_specialty'],
                'd_email' => $_POST['d_email'],
                'd_password' => $_POST['d_password'],
                'd_phone_no' => $_POST['d_phone_no'],
                'd_avail_from' => $_POST['d_avail_from'],
                'd_avail_to' => $_POST['d_avail_to'],
                'd_avail_status' => $_POST['d_avail_status'] ?? '',
                'd_fee' => $_POST['d_fee'],
                'd_rating' => $_POST['d_rating'],
            ];
            $errors = validate_core_doctor($newData);
            if (!empty($errors)) {
                echo json_encode([
                    'status' => 'error',
                    'errors' => $errors
                ]);
                exit;
            }
            echo json_encode([
                'status' => 'success',
                'message' => 'Form submitted successfully'
            ]);
//            print_r($newData); // be sure to comment it out after debugging
            $doctor->insert($newData);
            $user = new User();
            $userData = [
                'email' => $_POST['d_email'],
                'password' => $_POST['d_password'],
                'role' => 'doctor',
                'd_reg_no' => $_POST['d_reg_no']
            ];
            $user->insert($userData);
//            $this->view('admin/manage_doctors');
            exit;
        }
        $this->view('admin/add_doctor', ['errors' => $errors]);
    }

    public function update_doctor()
    {
//        print_r($_GET);
        $d_reg_no = $_GET['d_reg_no'];
        $doctor = new Doctor();
        $doctor_data = $doctor->first(['d_reg_no' => $d_reg_no]);
        $data = [
            'd_reg_no' => $doctor_data['d_reg_no'],
            'd_first_name' => $doctor_data['d_first_name'],
            'd_last_name' => $doctor_data['d_last_name'],
            'd_title' => $doctor_data['d_title'],
            'd_birth_date' => $doctor_data['d_birth_date'],
            'd_gender' => $doctor_data['d_gender'],
            'd_email' => $doctor_data['d_email'],
            'd_password' => $doctor_data['d_password'],
            'd_specialty' => $doctor_data['d_specialty'],
            'd_phone_no' => $doctor_data['d_phone_no'],
            'd_avail_from' => $doctor_data['d_avail_from'],
            'd_avail_to' => $doctor_data['d_avail_to'],
            'd_avail_status' => $doctor_data['d_avail_status'],
            'd_fee' => $doctor_data['d_fee'],
            'd_rating' => $doctor_data['d_rating']
        ];
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            header('Content-Type: application/json');
            $updatedData = [
                'd_reg_no' => $_POST['d_reg_no'],
                'd_first_name' => $_POST['d_first_name'],
                'd_last_name' => $_POST['d_last_name'],
                'd_title' => $_POST['d_title'],
                'd_birth_date' => $_POST['d_birth_date'],
                'd_gender' => $_POST['d_gender'],
                'd_specialty' => $_POST['d_specialty'],
                'd_email' => $_POST['d_email'],
                'd_password' => $_POST['d_password'],
                'd_phone_no' => $_POST['d_phone_no'],
                'd_avail_from' => $_POST['d_avail_from'],
                'd_avail_to' => $_POST['d_avail_to'],
                'd_avail_status' => $_POST['d_avail_status'],
                'd_fee' => $_POST['d_fee'],
                'd_rating' => $_POST['d_rating']
            ];
            $errors = validate_core_doctor($updatedData);
            if (!empty($errors)) {
                echo json_encode([
                    'status' => 'error',
                    'errors' => $errors
                ]);
//                var_dump($errors);
                exit;
            }
            echo json_encode([
                'status' => 'success',
                'message' => 'Form submitted successfully'
            ]);
            $doctor->update($d_reg_no, $updatedData, 'd_reg_no');
            exit;
        }
        $this->view('admin/update_doctor', ['data' => $data, 'errors' => $errors]);
    }

    public
    function manage_patients()
    {
        $user = get_user();
        if ($user->role != 'admin') {
            redirect('login');
        }
        $patient = new Patient;
        $patients = $patient->find_all();

        $data = [
            'user' => $user,
            'patients' => $patients,
            'title' => 'Manage Patients - Telemedicine++',
        ];
        $this->view('admin/manage_patients', $data);
    }

    public
    function manage_appointments()
    {
        $appointment = new Appointment;
        $appointments = $appointment->find_all();

        $data = [
            'appointments' => $appointments,
            'title' => 'Manage Appointments - Telemedicine++',
        ];
        $this->view('admin/manage_appointments', $data);
    }

    public function delete_doctor()
    {
        $doctor = new Doctor();
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            // Process deletion of a doctor
            if (isset($_GET['d_reg_no'])) {
                $d_reg_no = $_GET['d_reg_no'];
                var_dump($d_reg_no);
                $doctor->delete($d_reg_no, 'd_reg_no');
            }
            // Redirect to avoid resubmission
                redirect('admin/manage_doctors');
        }
    }
    public function announcements()
    {
        $announcement = new Announcement;
        $announcements = $announcement->find_all();
        
        $this->view('admin/announcements', $data = [
            'announcements' => $announcements,
        ]);
    }
    public function add_announcement()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $announcement = new Announcement();
            $data = [
                'text' => $_POST['text'],
                'created_at' => date('Y-m-d H:i:s')
            ];
            $announcement->insert($data);
//            redirect('adminPortal/announcements');
        }
        $this->view('admin/add_announcement');
    }
}