<?php
include "database.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <title>CRUD</title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #FF3E41;">
    CRUD ADMIN
  </nav>

  <div class="container">
    <?php
    if (isset($_GET["msg"])) {
      $msg = $_GET["msg"];
      echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
      ' . $msg . '
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <div>
        <a href="add.php" class="btn btn-dark mb-3">Add New</a>
        <a href="login.php" class="btn btn-dark mb-3">login</a>

    </div>


    <table class="table table-hover text-center">
      <thead class="table-dark">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Email</th>
          <th scope="col">password</th>
          <th scope="col">telephone</th>
          <th scope="col">ville</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
      <?php

class Client {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllClients() {
        $sql = "SELECT * FROM clients";
        $result = mysqli_query($this->conn, $sql);

        return $result;
    }

    public function displayClients() {
        $result = $this->getAllClients();
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>{$row['id_client']}</td>
                    <td>{$row['firstname']}</td>
                    <td>{$row['lastname']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['password']}</td>
                    <td>{$row['telephone']}</td>
                    <td>{$row['ville']}</td>
                    <td>
                        <a href='update.php?id_client={$row['id_client']}' class='link-dark'>
                            <i class='fa-solid fa-pen-to-square fs-5 me-3'></i>
                        </a>
                        <a href='delete.php?id_client={$row['id_client']}' class='link-dark'>
                            <i class='fa-solid fa-trash fs-5'></i>
                        </a>
                    </td>
                </tr>";
        }
    }
}

$client = new Client($conn);  
$client->displayClients();     
?>

      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
