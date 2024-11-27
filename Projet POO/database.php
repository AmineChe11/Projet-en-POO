<?php

class Database {
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "pharmacie";
    private $conn;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $this->conn = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);
        
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function getConnection() {
        return $this->conn;
    }

    public function closeConnection() {
        if ($this->conn) {
            mysqli_close($this->conn);
        }
    }
}

$db = new Database();
$conn = $db->getConnection();

$db->closeConnection();

?>
