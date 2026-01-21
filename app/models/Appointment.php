<?php


class Appointment
{
    use Model;

    protected $table = 'appointments';
    protected $allowedColumns = [
        'p_id',
        'd_id',
        'appointment_date',
        'appointment_time',
        'creation_date'
    ];

    // specify which columns are allowed to be inserted or updated


    public function getPatientsByDoctor($d_id)
    {
        $query = "SELECT p.*, a.appointment_date, a.appointment_time FROM appointments a JOIN patients p ON a.p_id = p.id WHERE a.d_id = ? ORDER BY a.appointment_date DESC";

        $conn = $this->connect();
        $stmt = $conn->prepare($query);

        if ($stmt) {
            // bind parameter
            $stmt->bind_param("i", $d_id);

            // execute
            $stmt->execute();

            // fetch result
            $result = $stmt->get_result();
            $data = [];

            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            // cleanup
            $stmt->close();
            $conn->close();

            return $data;
        }

        return false;
    }
    public function getDoctorsByPatient($p_id)
    {
        $query = "SELECT d.*, a.appointment_date, a.appointment_time FROM appointments a JOIN doctors d ON a.d_id = d.id WHERE a.p_id = ? ORDER BY a.appointment_date DESC";

        $conn = $this->connect();
        $stmt = $conn->prepare($query);

        if ($stmt) {
            // bind parameter
            $stmt->bind_param("i", $p_id);

            // execute
            $stmt->execute();

            // fetch result
            $result = $stmt->get_result();
            $data = [];

            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }

            // cleanup
            $stmt->close();
            $conn->close();

            return $data;
        }

        return false;
    }
}