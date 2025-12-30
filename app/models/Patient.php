<?php

class Patient
{
    use Model;
    protected $table = 'patients';
    protected $allowedColumns = [
        'p_nid_no',
        'p_first_name',
        'p_last_name',
        'p_birth_date',
        'p_gender',
        'is_sensory_disabled',
        'p_email',
        'p_password',
        'p_phone_no',
        'p_address',
        'p_blood_group'
    ];
}