<?php

session_start();

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
    <title>Forgot Password</title>

    <style>
        .title_forgot_pass {
            text-align: center;
            font-size: 211%;
            margin-top: 2%;
        }
    </style>

</head>

<body>

    <div class="title_forgot_pass">Forgot Password</div>

    <!-- Form for entering email and clicking 'send otp' -->
    <form action="" method="POST" class="container my-3" style="width: 50%;">
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div>
        <button name="sendotpbtn" id="sendotpbtnid" class="btn btn-primary" type="submit">Send otp</button>
    </form>



    <!--  After 'send otp' button is clicked -->
    <?php

    if (isset($_POST['sendotpbtn'])) {

        /* Check if the email entered has an account or not */
        include('../AdminSide/db.php');
        $exists = mysqli_query($con, "select * from passengertb where email='" . $_POST['email'] . "'");

        if (mysqli_affected_rows($con) == 0) {
            // Email doesn't exists then execute the below code
    ?>
            <script>
                let a = confirm("Email doesn't exists!!");
                if (a || !a) {
                    window.location.href('../Login.php');
                }
            </script>

        <?php

        } else
        // Email exits then execute the following code(send otp)
        {
            // Send email along with the generated the otp
            $otp = rand(100000, 999999);
            $_SESSION['otp'] = $otp;
            $_SESSION['email'] = $_POST['email'];

            $body = "Otp for setting your new password is : " . $otp . "\n Do not share this code with anyone.";
            if (mail($_POST['email'], "AirTravel", $body)) {
                echo "<script>alert('Otp sent successfully to " . $_POST['email'] . "');</script>";
            } else {
                echo "<script>alert('Otp sending failed!! Try again');</script>";
            }

            echo "<script>
                document.getElementById('sendotpbtnid').disabled = true;
            </script>";
        ?>
            <!-- Form for entering the otp, new password and confirm password -->
            <form action="" method="POST" class="container my-3" style="width: 50%;">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Enter the otp</label>
                    <input type="text" name="otpinput" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">New password</label>
                    <input type="text" name="passwordinput" class="form-control" id="exampleFormControlInput1">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Confirm password</label>
                    <input type="password" name="confirmpasswordinput" class="form-control" id="exampleFormControlInput1">
                </div>
                <button name="changepasswordbtn" class="btn btn-primary" type="submit">Change Password</button>
            </form>
    <?php
        }
    }
    ?>


    <!-- After 'Change Password' button click -->
    <?php

    if (isset($_POST['changepasswordbtn'])) {

        /* Checking otp validness and confirming new and  re-entered new password*/
        if (($_POST['otpinput'] == $_SESSION['otp']) && ($_POST['passwordinput'] == $_POST['confirmpasswordinput'])) {

            include('../AdminSide/db.php');

            // $result = mysqli_query($con, "UPDATE passengertb SET pass = '" . $_POST['passwordinput'] . "' WHERE email='" . $_SESSION['email'] . "';");
            $result = mysqli_query($con, "UPDATE `passengertb` SET `pass` = '" . $_POST['passwordinput'] . "' WHERE `passengertb`.`email` = '" . $_SESSION['email'] . "';");

            if ($result) {
                session_unset();
                session_destroy();

                // This is the alert used from the bootstrap
                echo "<div class=' fixed-top alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>Password has been changed successfully!! Go to <a href='../Login.php'>Login Page</a>
            </div>";
            } else {
                echo "<script>alert('Failed resetting your password!!');</script>";
            }
        } else {
            echo "<script>alert('Otp/password matching failed!!');</script>";
        }
    }

    ?>

</body>

</html>