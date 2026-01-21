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
    
    public function setStatus ($d_reg_no, $statusData)
    {
        $query = "UPDATE " . $this->table . " SET d_avail_status = ?, d_avail_from = ?, d_avail_to = ? WHERE d_reg_no = ?";

        $conn = $this->connect();
        $stmt = $conn->prepare($query);

        if ($stmt) {
            // bind parameters
            $stmt->bind_param(
                "sssi",
                $statusData['d_avail_status'],
                $statusData['d_avail_from'],
                $statusData['d_avail_to'],
                $d_reg_no
            );

            // execute
            $result = $stmt->execute();

            // cleanup
            $stmt->close();
            $conn->close();

            return $result;
        }

        return false;
    }
}