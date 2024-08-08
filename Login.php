<?php

include('AdminSide/db.php');


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <title>Login</title>
</head>

<body>
    <!-- Login Form -->
    <div class="container my-3">
        <span style="display: block; text-align: center; font-size: 300%;">Login</span>

        <form method="POST" action="Login.php">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
            </div>

            <div class="submitbtn_class" style="text-align: center;">
                <button type="submit" name="btnlogin" class="btn btn-primary">Login</button>
            </div>
        </form>
    </div>

    <!-- Links -->
    <div class="section" style="justify-content: space-around; display: flex;">
        <div class="Register">
            <span>Don't have an account?</span>
            <span><a href="./UserSide/Register.php">Create Account</a></span>
        </div>
        <div class="Forgot_password">
            <span>Forgot your password?</span>
            <span><a href="./UserSide/ForgotPassword.php">Forgot Password</a></span>
        </div>
    </div>

    <!-- Login button is clicked -->
    <?php
    if (isset($_POST['btnlogin'])) {
        // Admin Login
        if ($_POST['email'] == 'admin@gmail.com' && $_POST['password'] == 'admin') {
            session_start();
            $_SESSION['admin'] = 'admin';
            header('location: AdminSide/showAccounts.php');
        }

        // User's Login
        $rows = mysqli_query($con, "select * from passengertb where email='" . $_POST['email'] . "' and pass='" . $_POST['password'] . "'");


        if (mysqli_affected_rows($con) == 1) {

            $row  = mysqli_fetch_array($rows);
            session_start();
            $_SESSION['pid'] = $row[0];

            header('location: ./Userside/index.php');
        } else {
            echo "<script>alert('Invalid Login credentials!!');</script>";
        }
    }
    ?>

</body>

</html>