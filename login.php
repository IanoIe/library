<?php
   //include("connection.php");
   include("tampletes/header.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <?php
            if (isset($_POST["login"])) {
                $email = $_POST["email"];
                $password = $_POST["password"];
                require_once "database.php";
                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
                if ($user) {
                    if (password_verify($password, $user["pass"])){
                        if ($user["email"] == "ma@gmail.com") {
                            header("Location: indexAdmin.php");
                            die();
                        } else {
                            header("Location: index.php");
                            die();
                        }
                    }else {
                        echo "<div class='alert alert-danger'>Password does not match</div>";
                    }

                }else {
                    echo "<div class='alert alert-danger'>Email does not match</div>";
                }
            }
        ?>
        <form action="login.php" method="post">
            <div class="form-group">
                <input type="email" placeholder="Enter Email: " name="email" class="form-control">
            </div>
            <div class="form-group">
                <input type="password" placeholder="Enter passowrd: " name="password" class="form-control">
            </div>
            <div class="form-btn">
                <input type="submit" value="Login" name="login" class="btn btn-primary">
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                      <button type="button" class="btn btn-link">Register</button>
                </div>
            </div>
        </form>
    </div>
    
</body>
</html>
