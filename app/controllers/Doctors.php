<?php

class Doctors
{
    use Controller;

    public function index()
    {
        if (empty($this->get_id_from_url())) {
            $this->landing_page();
        } else {
            $doctor_data = $this->get_doctor_from_url();
            $this->view('create_appointment', [
                'doctor_data' => $doctor_data
            ]);

            //create appointment page
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//            var_dump($_POST);
                if (!isset($_SESSION['id'])) {
                    redirect('login');
                }
                $appointment = new Appointment();
                $data = [
                    'p_id' => $_SESSION['id'],
                    'd_id' => $doctor_data['id'],
                    'appointment_date' => $_POST['appointment_date'],
                    'appointment_time' => $_POST['appointment_time'],
                    'creation_date' => date('Y-m-d H:i:s')
                ];
                $appointment->insert($data);
                var_dump($_SESSION);
                if ($_SESSION['role'] === 'patient') {
                    redirect_by_role('patient');
                } elseif ($_SESSION['role'] === 'admin') {
                    redirect_by_role('admin');
                }
            }
        }
    }


    public function landing_page()
    {
        $doctor = new Doctor();
        $specialties = $doctor->distinct('d_specialty');
        $genders = $doctor->distinct('d_gender');
        $page = $_GET['page'] ?? 1;
        $offset = (abs($page) - 1) * 3;
//        show($page);
        $all_doctors = $doctor->get_paginated(3, abs($offset));

//        print_r($all_doctors);
//        show($all_doctors);
        $this->view('doctors', [
            'all_doctors' => $all_doctors,
            'specialties' => $specialties,
            'genders' => $genders
        ]);
    }

    public
    function get_id_from_url()
    {
        $url = $_REQUEST['url'] ?? '';
        $url_parts = explode('/', $url);

        $id = end($url_parts);
        if (is_numeric($id)) {
            return $id;
        } else {
            return false;
        }
    }

    public
    function get_doctor_from_url()
    {
        $id = $this->get_id_from_url();
        $doctor = new Doctor();
        $doctor_data = $doctor->first(['id' => $id]);
        if (!$doctor_data) {
            return false;
        } else {
//            show($doctor_data);
            return $doctor_data;
        }
    }

}

