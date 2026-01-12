<?php


class Appointment
{
    use Model;

    protected $table = 'appointments';
    protected $allowedColumns = [
        'p_id',
        'd_id',
        'creation_date'
    ]; 
    // specify which columns are allowed to be inserted or updated
}