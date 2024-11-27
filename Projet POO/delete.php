<?php
include 'database.php';

class Client {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function deleteClient($id) {
        $sql = "DELETE FROM clients WHERE id_client = ?";
        
        $stmt = mysqli_prepare($this->conn, $sql);
        if ($stmt === false) {
            return false;
        }

        mysqli_stmt_bind_param($stmt, 'i', $id);

        $result = mysqli_stmt_execute($stmt);

        return $result;
    }
}

if (isset($_GET["id_client"])) {
    $id = $_GET["id_client"];
    
    $client = new Client($conn);
    
    if ($client->deleteClient($id)) {
        header("Location: admin.php?msg=Data deleted successfully");
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}
?>
