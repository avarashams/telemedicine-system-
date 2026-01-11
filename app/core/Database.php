<?php

trait Database
{
    private function connect()
    {
//        $string = "mysql:hostname=" . DBHOST . ";dbname=" . DBNAME; // database connection string
//        return $conn = new PDO($string, DBUSER, DBPASS); // create a new PDO connection PDO (PHP Data Objects)
        // mysqli procedural connection
        $conn = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
//        echo "Connected successfully";
        return $conn;
    }

//    public function query($query, $data = [])
//    {
//        $conn = $this->connect(); // connect to the database
//        $stmt = $conn->prepare($query); // prepare the query in statement
//
//        $check = $stmt->execute($data);
//        if ($check) {
//            $result = $stmt->fetchAll(PDO::FETCH_OBJ); // fetch all results as objects
//
//            if (is_array($result) && count($result) > 0) {
//                return $result;
//            }
//        }
//        return false;
//    }
//    public function get_row($query, $data = [])
//    {
//        $conn = $this->connect(); // connect to the database
//        $stmt = $conn->prepare($query); // prepare the query in statement
//
//        $check = $stmt->execute($data);
//        if ($check) {
//            $result = $stmt->fetchAll(PDO::FETCH_OBJ); // fetch all results as objects
//
//            if (is_array($result) && count($result) > 0) {
//                return $result[0];
//            }
//        }
//        return false;
//    }
    // query method using mysqli
//    public function query($query, $data = [])
//    {
//        $conn = $this->connect();
//        $stmt = mysqli_prepare($conn, $query);
//        
//        // Bind parameters if data is provided
//        if (!empty($data)) {
//            // Create a string of types for the bind_param function
//            
//    }
}

