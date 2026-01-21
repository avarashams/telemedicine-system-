<?php

class PatientPortal
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
//        show($user);
        if ($user->role != 'patient') {
            redirect('login');
        }
        $patient = new Patient();
        $patient_data = $patient->first(['p_nid_no' => $user->p_nid_no]);
        $appointment = new Appointment();
        $appointments = $appointment->where(['p_id' => $patient_data['id']]);
        if (!$appointments) {
            $data = [
                'appointments_count' => 0,
            ];
            $this->view('patient/dashboard', $data);
            return;
        }
        $doctors_with_appointments = $appointment->getDoctorsByPatient($appointments['p_id']);
//        show($user);
//        show();
//        show($patient_data);

        $data = [
            'appointments_count' => count($doctors_with_appointments),
        ];
        $this->view('patient/dashboard', $data);
    }

    public function manage_appointments()
    {
        require_login();
        $user = get_user();

        if ($user->role != 'patient') {
            redirect('login');
        }
        $patient = new Patient();
        $patient_data = $patient->first(['p_nid_no' => $user->p_nid_no]);
        $appointment = new Appointment;
        $appointments = $appointment->where(['p_id' => $patient_data['id']]);
        if (!$appointments) {
            $data = [
                '$appointment_data' => [],
                'doctor_data' => []
            ];
            $this->view('patient/manage_appointments', $data);
            return;
        }
        $doctors_with_appointments = $appointment->getDoctorsByPatient($appointments['p_id']);
        $data = [
            '$appointment_data' => $appointments,
            'doctor_data' => $doctors_with_appointments
        ];

        $this->view('patient/manage_appointments', $data);
    }

    public function profile()
    {
        require_login();
        $user = get_user();

        if ($user->role != 'patient') {
            redirect('login');
        }

        $patient = new Patient();
        $patient_data = $patient->first(['p_nid_no' => $user->p_nid_no]);

        $data = [
            'p_nid_no' => $patient_data['p_nid_no'],
            'p_first_name' => $patient_data['p_first_name'],
            'p_last_name' => $patient_data['p_last_name'],
            'p_birth_date' => $patient_data['p_birth_date'],
            'p_gender' => $patient_data['p_gender'],
            'is_sensory_disabled' => $patient_data['is_sensory_disabled'],
            'p_email' => $patient_data['p_email'],
            'p_password' => $patient_data['p_password'],
            'p_phone_no' => $patient_data['p_phone_no'],
            'p_address' => $patient_data['p_address'],
            'p_blood_group' => $patient_data['p_blood_group']
        ];
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            header('Content-type: application/json');
            $updatedData = [
                'p_nid_no' => $_POST['p_nid_no'],
                'p_first_name' => $_POST['p_first_name'],
                'p_last_name' => $_POST['p_last_name'],
                'p_birth_date' => $_POST['p_birth_date'],
                'p_gender' => $_POST['p_gender'],
                'is_sensory_disabled' => $_POST['is_sensory_disabled'],
                'p_email' => $_POST['p_email'],
                'p_password' => $_POST['p_password'],
                'p_phone_no' => $_POST['p_phone_no'],
                'p_address' => $_POST['p_address'],
                'p_blood_group' => $_POST['p_blood_group']
            ];
            $errors = validate_core_patient($updatedData);
            if(!empty($errors)){
                echo json_encode([
                    'status' => 'error',
                    'errors' => $errors
                ]);
                exit;
            }
            echo json_encode([
                'status' => 'success',
                'message' => 'Profile updated successfully'
            ]);
            $patient->update($patient_data['id'], $updatedData);
            exit;
        }

        $this->view('patient/profile', $data = [
            'data' => $patient_data
        ]);
    }
}