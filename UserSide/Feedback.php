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

    <title>Feedback</title>

    <style>
        * {
            margin: 0%;
            padding: 0%;
        }

        .section {
            background: url('../Images/register_bg_img.jpg');
            background-size: cover;
            padding: 3%;
        }

        .main_cont {
            border: 2px solid black;
            width: 68%;
            text-align: center;
            margin: 0% auto;
            padding: 4% 0px;
            opacity: 0.9;
            background: white;
        }

        .title {
            font-size: 240%;
            margin-bottom: 4%;
            text-decoration: underline;
        }

        span {
            display: block;
            font-size: 122%;
            margin: 2%;
        }

        input {
            border: 2px solid grey;
            border-radius: 21px;
            padding: 14px;
            width: 54%;
        }

        textarea {
            border-radius: 21px;
            font-size: 144%;
            width: 79%;
            padding: 14px;
            border: 2px solid gray;
        }

        .submitbtn {
            margin-top: 3%;
            font-size: 119%;
            padding: 1% 3%;
            border: 2px solid;
            border-radius: 5px;
            background: #454348;
            color: white;
        }

        .submitbtn:hover {
            background: transparent;
            color: black;
        }
    </style>

</head>

<body>
    <!-- Navbar -->
    <?php include('../Components/Navbar_User.php'); ?>

    <!-- Feedback Form -->
    <div class="section">
        <form method="POST" action="" class="container main_cont">
            <span class="title">Feedback Form</span>

            <div class="">
                <span>Subject</span>
                <input type="text" name="subject" placeholder="Enter the subject" required>
            </div>
            <div class="">
                <span>Description</span>
                <textarea rows="6" name="description" placeholder="Enter your concern here" required></textarea>
            </div>

            <button type="submit" name="submitbtn" class="submitbtn">Submit</button>
        </form>
    </div>

    <?php

    // Sending Feedback
    if (isset($_POST['submitbtn'])) {
        $subject = $_POST['subject'];
        $description = $_POST['description'];

        $result = mysqli_query($con, "insert into feedbacktb values(NULL," . $_SESSION['pid'] . ",current_timestamp(),'" . $subject . "','" . $description . "');");
        if ($result) {
            echo "<script>alert('Thanks for your valuable feedback ;)');</script>";
        } else {
            //   echo mysqli_error($con);
            echo "<script>alert('Feedback submission failed ); Please try again');</script>";
        }
    }
    ?>


    <!-- Footer -->
    <?php include('../Components/Footer.php'); ?>

</body>

</html>