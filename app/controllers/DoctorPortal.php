<?php

class DoctorPortal
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
        $doctor = new Doctor();
        $doctor_data = $doctor->first(['d_email' => $user->email]);
//        var_dump($doctor_data);

        $appointment = new Appointment;
        $appointments = $appointment->where(['d_id' => $doctor_data['id']]);
//        show($appointments);
        $patients_with_appointments = $appointment->getPatientsByDoctor($appointments['d_id']);
        $announcement = new Announcement();
        $announcements = $announcement->find_all(1);
        $data = [
            'appointments_count' => count($patients_with_appointments),
            'd_avail_status' => $doctor_data['d_avail_status'],
            'announcements' => $announcements[0]['text']
        ];
//        show($data);
        $this->view('doctor/dashboard', $data);
    }

    public function manage_appointments()
    {
        require_login();
        $user = get_user();
//        var_dump($user);
        if ($user->role != 'doctor') {
            redirect('login');
        }
        $doctor = new Doctor();
        $doctor_data = $doctor->first(['d_email' => $user->email]);
//        var_dump($doctor_data);

        $appointment = new Appointment;
        $appointments = $appointment->where(['d_id' => $doctor_data['id']]);
//        show($appointments);
        $patients_with_appointments = $appointment->getPatientsByDoctor($appointments['d_id']);
//        var_dump($patients_with_appointments);
//        show($patients_with_appointments);
        $data = [
            '$appointment_data' => $appointments,
            'patient_data' => $patients_with_appointments
        ];

        $this->view('doctor/manage_appointments', $data);
    }

    public function profile()
    {
        require_login();
        $user = get_user();
//        var_dump($user);
        if ($user->role != 'doctor') {
            redirect('login');
        }
        $doctor = new Doctor();
        $doctor_data = $doctor->first(['d_email' => $_SESSION['email']]);
//        show($_SESSION);
//        show($doctor_data);
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
            $doctor->update(['d_reg_no' => $doctor_data['d_reg_no']], $updatedData, 'd_reg_no');
            exit;
        }
        $this->view('doctor/profile', $data = [
            'data' => $doctor_data
        ]);
    }

    public function set_status()
    {
        require_login();
        $user = get_user();
        if ($user->role != 'doctor') {
            redirect('login');
        }
        $doctor = new Doctor();
        $doctor_data = $doctor->first(['d_email' => $user->email]);

        $data = [
            'd_avail_status' => $doctor_data['d_avail_status'],
            'd_avail_from' => $doctor_data['d_avail_from'],
            'd_avail_to' => $doctor_data['d_avail_to']
        ];
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//            header('Content-Type: application/json');
            $updatedData = [
                'd_avail_status' => $_POST['d_avail_status'],
                'd_avail_from' => $_POST['d_avail_from'],
                'd_avail_to' => $_POST['d_avail_to']
            ];
            // validate input date
            if ($updatedData['d_avail_from'] > $updatedData['d_avail_to']) {
                $errors['error'] = "Available From date cannot be later than Available To date.";
            }
            if (empty($errors)) {
                $doctor->setStatus($doctor_data['d_reg_no'], $updatedData);
                $data['message'] = "Availability status updated successfully.";
                $data = $updatedData;
            }
//            show($data);
        }

        $this->view('doctor/set_status', $data = [
            'data' => $data,
            'errors' => $errors
        ]);
    }

    public function generate_report()
    {
        require_login();
        $user = get_user();
        if ($user->role != 'doctor') {
            redirect('login');
        }
        //        show($_GET);
        if (!isset($_GET['p_nid_no'])) {
            redirect('doctorPortal/manage_appointments');
        }
        $patient_nid = $_GET['p_nid_no'];
        $patient = new Patient();
        $patient_data = $patient->first(['p_nid_no' => $patient_nid]);
//        show($patient_data);
        $age = date_diff(date_create($patient_data['p_birth_date']), date_create('today'))->y; // y mean years
        $disability = $patient_data['is_sensory_disabled'] ? 'Yes' : 'No';
        $data = [
            'p_nid_no' => $patient_data['p_nid_no'],
            'p_first_name' => $patient_data['p_first_name'],
            'p_last_name' => $patient_data['p_last_name'],
            'age' => $age,
            'p_gender' => $patient_data['p_gender'],
            'is_sensory_disabled' => $disability,
            'p_email' => $patient_data['p_email'],
            'p_phone_no' => $patient_data['p_phone_no'],
            'p_address' => $patient_data['p_address'],
            'p_blood_group' => $patient_data['p_blood_group'],
        ];       
        $this->view('doctor/generate_report', $data = [
            'patient_data' => $data
        ]);
    }
    public function add_report()
    {
        require_login();     
        $user = get_user();
        if ($user->role != 'doctor') {
            redirect('login');
        }
        $patient_nid = $_GET['p_nid_no'];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $report_content = $_POST['report_content'];
            $report = new Report();
            $doctor = new Doctor();
            $doctor_data = $doctor->first(['d_email' => $user->email]);
            $report_data = [
                'p_nid_no' => $patient_nid,
                'd_reg_no' => $doctor_data['d_reg_no'],
                'text' => $report_content,
                'created_at' => date('Y-m-d H:i:s')
            ];
//            show($report_data);
            $report->insert($report_data);
            redirect('doctorPortal/manage_appointments');
        }
    }
}