<?php
session_start();

// Do not display this page if the user have not logged in
if (!$_SESSION['pid']) {
    header('location: ./index.php');
}

// $_SESSION['pid'] = '1';
include('../AdminSide/db.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Profile</title>

    <style>
        .contClass{
            background: url("../Images/carousel(3).jfif");
            background-size: cover;
        }
    </style>
</head>

<body>

    <?php include('../Components/Navbar_User.php'); ?>

        <!-- Fetch the details of the user -->
    <?php
    $rows = mysqli_query($con, "select * from passengertb where  pid='" . $_SESSION['pid'] . "'");

    while ($row = mysqli_fetch_array($rows)) {
        $id = $row[0];
        $fname = $row[1];
        $lname = $row[2];
        $bdate = $row[3];
        $passportno = $row[4];
        $email = $row[6];
        $pass = $row[7];
    }

    ?>

    <div class="contClass">

        <h1 style="text-align: center;" class="py-3">My Profile</h1>

        <!-- Form -->
        <div class="container-fluid py-3" style="display: flex;">

            <form action="" method="POST" class="left-section" style="width: 70%; text-align: center; ">
                <div class="mb-3 row" style="border: 2px;">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Passenger Id</label>
                    <div class="col-sm-10">
                        <input type="text" name="id" readonly class="form-control-plaintext" id="id" value="<?php echo $id ?>" style="border: 2px solid;width: 40%; text-align: center;">
                    </div>
                </div>
                <div class="mb-3 row" style="border: 2px;">
                    <label for="staticEmail" class="col-sm-2 col-form-label">First Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="fname" readonly class="form-control-plaintext" id="fname" value="<?php echo $fname ?>" style="border: 2px solid;width: 40%; text-align: center;">
                    </div>
                </div>
                <div class="mb-3 row" style="border: 2px;">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Last Name</label>
                    <div class="col-sm-10">
                        <input type="text" name="lname" readonly class="form-control-plaintext" id="lname" value="<?php echo $lname ?>" style="border: 2px solid;width: 40%; text-align: center;">
                    </div>
                </div>
                <div class="mb-3 row" style="border: 2px;">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Birth Date</label>
                    <div class="col-sm-10">
                        <input type="text" name="bdate" readonly class="form-control-plaintext" id="bdate" value="<?php echo $bdate ?>" style="border: 2px solid;width: 40%; text-align: center;">
                    </div>
                </div>
                <div class="mb-3 row" style="border: 2px;">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Passport No</label>
                    <div class="col-sm-10">
                        <input type="text" name="passportno" readonly class="form-control-plaintext" id="passportno" value="<?php echo $passportno ?>" style="border: 2px solid;width: 40%; text-align: center;">
                    </div>
                </div>
                <div class="mb-3 row" style="border: 2px;">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" readonly class="form-control-plaintext" id="email" value="<?php echo $email ?>" style="border: 2px solid;width: 40%; text-align: center;">
                    </div>
                </div>
                <div class="mb-3 row" style="border: 2px;">
                    <label for="staticEmail" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="text" name="pass" readonly class="form-control-plaintext" id="pass" value="<?php echo $pass ?>" style="border: 2px solid;width: 40%; text-align: center;">
                    </div>
                </div>

                <span id="msg" style=" margin-left: -31%; margin-bottom: 1%; display: block; color: red; visibility: hidden;">
                    Change the values by clicking on the data!!
                </span>

                <!-- Buttons -->
                <div class="buttons" style="margin-right: 37%;">
                    <button class="btn btn-primary" id="updatebtn" name="updatebtn">Update Profile</button>
                    <button class="btn btn-primary" id="cancelbtn" name="cancelbtn" style="visibility: none;">Cancel</button>
                    <button class="btn btn-primary" id="savebtn" name="savebtn" style="visibility: hidden;">Save</button>
                </div>
            </form>

            <!-- <div class="right-setion" style="width: 30%; background: url('https://source.unsplash.com/200x200?laptop'); background-size: cover;">
        </div> -->
        </div>
    </div>

    <!-- Code for updation of user profile -->
    <?php

    if (isset($_POST['updatebtn'])) {
        // User wants to update his/her records
        // So, make the fields readonly=false using <script></script>
    ?>
        <script>
            document.getElementById('fname').readOnly = false;
            document.getElementById('lname').readOnly = false;
            document.getElementById('bdate').readOnly = false;
            document.getElementById('passportno').readOnly = false;
            document.getElementById('email').readOnly = false;
            document.getElementById('pass').readOnly = false;

            // After editing tthe fields, user's need the 'save' btn to confirms the updataion
            document.getElementById('updatebtn').style.visibility = 'hidden';
            document.getElementById('savebtn').style.visibility = 'visible';
            document.getElementById('msg').style.visibility = 'visible';
        </script>

    <?php
    }

    // Code to update the user profile
    // i.e,fire update query
    if (isset($_POST['savebtn'])) {

        $result = mysqli_query($con, "UPDATE `passengertb` SET `fname` = '" . $_POST['fname'] . "',`lname` = '" . $_POST['lname'] . "',`bdate` = '" . $_POST['bdate'] . "',`passportno` = '" . $_POST['passportno'] . "',`email` = '" . $_POST['email'] . "',`pass` = '" . $_POST['pass'] . "'  WHERE `passengertb`.`pid` = " . $_SESSION['pid'] . ";");

        if ($result) {
            echo "<script>alert('Details updated successfully!!'); window.location.assign('Profile.php');</script>";
        } else {
            echo "<script>alert('Details updation failed!!'); window.location.assign('Profile.php');</script>";
            // echo mysqli_error($con);
        }
    }

    ?>


    <!-- Footer -->
    <?php include('../Components/Footer.php'); ?>

</body>

</html>