<?php

class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "ualbanyglobalconnect_db";

    // Establish a database connection
    public function connect()
    {
        $connection = mysqli_connect($this->host, $this->username, $this->password, $this->db);
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $connection;
    }

    // Execute a SELECT query and fetch data
    public function read($query)
    {
        $conn = $this->connect();
        $result = mysqli_query($conn, $query);

        if (!$result) {
            return false; // Return false if query fails
        } else {
            $data = array(); // Initialize an empty array
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row; // Add each row to the data array
            }
            return $data; // Return the data array
        }
    }

    // Execute a INSERT, UPDATE, DELETE query
    public function save($query)
    {
        $conn = $this->connect();
        $result = mysqli_query($conn, $query);

        if (!$result) {
            return false;// Return false if query fails
        } else {
            return true; // Return true if query succeeds
        }
    }
}

// Create a new instance of the Database class
$DB = new Database();

?>
