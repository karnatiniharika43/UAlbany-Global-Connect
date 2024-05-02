<?php

class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "ualbanyglobalconnect_db";
    private $connection;

    public function __construct()
    {
        $this->connection = $this->connect();
    }

    private function connect()
    {
        $connection = mysqli_connect($this->host, $this->username, $this->password, $this->db);
        if (!$connection) {
            die("Connection failed: " . mysqli_connect_error());
        }
        return $connection;
    }

    public function read($query)
    {
        $result = mysqli_query($this->connection, $query);
        if (!$result) {
            // Log error or throw exception
            return false;
        } else {
            $data = array();
            while ($row = mysqli_fetch_assoc($result)) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function save($query)
{
    $result = mysqli_query($this->connection, $query);
    if (!$result) {
        // Log error or throw exception
        // Handle specific MySQL error codes, such as duplicate entry
        if (mysqli_errno($this->connection) == 1062) {
            // Duplicate entry error
            // You can provide a custom error message or take other actions as needed
            echo "Duplicate entry error: " . mysqli_error($this->connection);
        } else {
            // Handle other types of errors
            echo "Error: " . mysqli_error($this->connection);
        }
        return false;
    } else {
        return true;
    }
}


    public function closeConnection()
    {
        mysqli_close($this->connection);
    }
}

$DB = new Database();

// Example usage:
// $data = $DB->read("SELECT * FROM your_table");
// $success = $DB->save("INSERT INTO your_table (column1, column2) VALUES ('value1', 'value2')");

// Don't forget to close the connection when done:
// $DB->closeConnection();

?>
