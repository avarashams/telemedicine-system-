<?php

class Doctors
{
    use Controller;
    public function index()
    {
        $doctor = new Doctor();
        
        $specialties = $doctor->distinct('d_specialty');
        $genders = $doctor->distinct('d_gender');
        $page = $_GET['page'] ?? 1;
        $offset = (abs($page) - 1) * 3;
//        show($page);
        $all_doctors = $doctor->get_paginated(3, abs($offset));
            
        
//        show($all_doctors);
        $this->view('doctors', [
            'all_doctors' => $all_doctors,
            'specialties' => $specialties,
            'genders' => $genders
        ]);
    }
}

