<?php

class Doctor
{
    use Model;

    protected $table = 'doctors';
    protected $allowedColumns = [
        'd_reg_no',
        'd_first_name',
        'd_last_name',
        'd_title',
        'd_birth_date',
        'd_gender',
        'd_specialty',
        'd_email',
        'd_password',
        'd_phone_no',
        'd_avail_from',
        'd_avail_to',
        'd_avail_status',
        'd_fee'
    ]; // specify which columns are allowed to be inserted or updated
    
}