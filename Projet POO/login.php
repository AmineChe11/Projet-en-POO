<?php

require('database.php'); 

class Auth {
    private $conn;
    private $errorMssg = "";
    private $succesMsg = "";

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function login($email, $password) {
        $query = "SELECT * FROM clients WHERE email=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("s", $email); 
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($password == $row['password']) {
                $_SESSION["login"] = true;
                $_SESSION["id"] = $row["id"];
                header("location: home.php");
                exit();
            } else {
                $this->errorMssg = "Invalid password";
            }
        } else {
            $this->errorMssg = "No user found with this email.";
        }

        return $this->errorMssg;
    }

    public function getErrorMssg() {
        return $this->errorMssg;
    }

    public function getSuccesMsg() {
        return $this->succesMsg;
    }
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $auth = new Auth($conn);
    
    $errorMssg = $auth->login($email, $password);

    if (!empty($errorMssg)) {
        echo $errorMssg;
    }
}

?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pharmacie</title>
    <!-- Font Awesome for social media icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body, html {
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .background {
            background-image: url('img/carousel-1.jpg'); /* Replace with your own background image */
            background-size: cover;
            background-position: center;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: -1;
            filter: brightness(0.6);
        }

        .signup-container {
            background-color: rgba(51, 51, 51, 0.9);
            padding: 50px;
            border-radius: 12px;
            width: 600px; /* Increase the width */
            text-align: center;
            color: #ffffff;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
            animation: fadeIn 1s ease-in-out;
        }

        .signup-container h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #ffffff;
            font-weight: bold;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .name-fields {
            display: flex;
            gap: 10px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            padding: 15px; /* Increase padding */
            border: 1px solid #444;
            border-radius: 6px;
            background-color: #555;
            color: #ffffff;
            transition: background-color 0.3s, box-shadow 0.3s;
            width: 100%;
        }

        input[type="text"]:focus,
        input[type="email"]:focus,
        input[type="password"]:focus {
            background-color: #666;
            box-shadow: 0 0 8px rgba(0, 123, 255, 0.6);
            outline: none;
        }

        input::placeholder {
            color: #ccc;
        }

        .checkbox {
            display: flex;
            align-items: center;
            font-size: 0.9em;
            color: #bbbbbb;
            gap: 10px;
        }

        .checkbox input {
            margin: 0;
            width: 16px;
            height: 16px;
        }

        button {
            padding: 15px;
            border: none;
            border-radius: 6px;
            background-color: #007bff;
            color: #ffffff;
            font-weight: bold;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        button:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        p {
            margin: 20px 0 10px;
            color: #aaa;
            font-size: 0.9em;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin-top: 10px;
        }

        .social-icons a {
            color: #ccc;
            font-size: 1.5em;
            transition: color 0.3s, transform 0.2s;
        }

        .social-icons a:hover {
            color: #ffffff;
            transform: scale(1.1);
        }

        /* Animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body>
    
    <div class="background"></div>
    <div class="signup-container">
        <h2>Login</h2>
        <form action="" method="post">
        <?php
        if(!empty ($errorMssg)){ 
        echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong> $errorMssg </strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>";
        }
        ?>
            <input type="email" name="email" placeholder="Email address" >

            <input type="password" name="password" placeholder="Password" value="<?php if(isset($emailValue)) echo $emailValue ?>" >
            <label class="checkbox">
                <input type="checkbox">
                <span>Subscribe to our newsletter</span>
            </label>
            <button name="submit" type="submit" value="Se connecter" >login</button>
            <div>
                <a href="signin.php" style="display: inline-block; padding: 10px 20px; background-color: #007bff; color: white; text-decoration: none; border: none; border-radius: 5px; transition: background-color 0.3s, transform 0.2s">SIGN UP</a>    
            </div>
            <?php
            if(!empty ($succesMsg)){
                echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong> $succesMsg </strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
            } 
            ?>
        </form>
        <p>or sign up with:</p>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-google"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-github"></i></a>
        </div>
    </div>
    
</body>

</html>