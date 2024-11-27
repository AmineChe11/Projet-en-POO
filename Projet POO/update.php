<?php
include 'database.php';

class Client {
    private $conn;
    private $id;
    private $first_name;
    private $last_name;
    private $email;
    private $password;
    private $telephone;
    private $ville;

    public function __construct($conn, $id = null) {
        $this->conn = $conn;
        $this->id = $id;
    }

    public function setClientData($first_name, $last_name, $email, $password, $telephone, $ville) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->password = $password;
        $this->telephone = $telephone;
        $this->ville = $ville;
    }

    public function updateClient() {
        $sql = "UPDATE clients SET 
                firstname = ?, 
                lastname = ?, 
                email = ?, 
                password = ?, 
                telephone = ?, 
                ville = ? 
                WHERE id_client = ?";

        $stmt = mysqli_prepare($this->conn, $sql);

        if ($stmt === false) {
            return false;
        }

        mysqli_stmt_bind_param($stmt, 'ssssssi', $this->first_name, $this->last_name, $this->email, $this->password, $this->telephone, $this->ville, $this->id);

        $result = mysqli_stmt_execute($stmt);

        return $result;
    }
}

if (isset($_GET["id_client"])) {
    $id = $_GET["id_client"];
    
    $client = new Client($conn, $id);

    if (isset($_POST["submit"])) {
        $first_name = $_POST['firstname'];
        $last_name = $_POST['lastname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $telephone = $_POST['telephone'];
        $ville = $_POST['ville'];

        $client->setClientData($first_name, $last_name, $email, $password, $telephone, $ville);

        if ($client->updateClient()) {
            header("Location: admin.php?msg=Data updated successfully");
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <title>CRUD</title>
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #FF3E41;">
    CRUD ADMIN
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>update Client Information</h3>
      <p class="text-muted">Click update after changing any information</p>
    </div>

    <?php
    $sql = "SELECT * FROM clients WHERE id_client = $id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
         <form action="" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">First Name:</label>
                  <input type="text" class="form-control" name="firstname" placeholder="first name">
               </div>

               <div class="col">
                  <label class="form-label">Last Name:</label>
                  <input type="text" class="form-control" name="lastname" placeholder="last name">
               </div>
            </div>

            <div class="mb-3">
               <label class="form-label">Email:</label>
               <input type="email" class="form-control" name="email" placeholder="EMAIL">
            </div>
            <div class="row mb-3">
               <div class="col">
                  <label class="form-label">Password:</label>
                  <input type="text" class="form-control" name="password" placeholder="password">
               </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                  <label class="form-label">Telephone:</label>
                  <input type="text" class="form-control" name="telephone" placeholder="telephone">
               </div>
               <div class="col">
                  <label class="form-label">Ville:</label>
                  <input type="text" class="form-control" name="ville" placeholder="ville">
               </div>
            </div>

            <div>
               <button type="submit" class="btn btn-success" name="submit">update</button>
               <a href="admin.php" class="btn btn-danger">Cancel</a>
            </div>
         </form>
      </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>