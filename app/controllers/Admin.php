<?php
class Admin
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
        $doctors = $doctor->find_all();
        
        $patient = new Patient;
        $patients = $patient->find_all();
        $data = [  
            'user' => $user,
            'title' => 'Admin Dashboard - Telemedicine++',
            'doctors_count' => count($doctors),
            'patients_count' => count($patients),
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
    public function manage_patients(){
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
}