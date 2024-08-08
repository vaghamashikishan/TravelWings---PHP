<?php
include('db.php');
session_start();

// If the admin have logged in then only this pages should be rendered
if (!$_SESSION['admin']) {
    header('location: ../UserSide/index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Flight</title>
</head>

<body>
    <!-- Navbar -->
    <?php include('../Components/Navbar_Admin.php'); ?>

    <h1 style="text-align: center;">Add New Flight</h1>
    <form action="" method="post">
        <div class="container">
            <div class="row" style="justify-content: center;">
                <div class="my-3 col-5">
                    <label for="exampleInputEmail1" class="form-label">Flight Name</label>
                    <input type="text" name="fname" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                </div>
                </row>
                <div class="row" style="justify-content: center;">
                    <div class="col-5 my-3">
                        <label for="exampleInputEmail1" class="form-label">Source</label>
                        <input type="text" name="fsource" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div class="col-5 my-3">
                        <label for="exampleInputEmail1" class="form-label">Destination</label>
                        <input type="text" name="fdest" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div class="col-5 my-3">
                        <label for="exampleInputEmail1" class="form-label">Business Seat Capacity</label>
                        <input type="number" name="businessseat" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div class="col-5 my-3">
                        <label for="exampleInputEmail1" class="form-label">Business Class Price</label>
                        <input type="text" name="businessprice" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div class="col-5 my-3">
                        <label for="exampleInputEmail1" class="form-label">First Seat Capacity</label>
                        <input type="number" name="firstseat" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div class="col-5 my-3">
                        <label for="exampleInputEmail1" class="form-label">First Class Price</label>
                        <input type="text" name="firstprice" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div class="col-5 my-3">
                        <label for="exampleInputEmail1" class="form-label">Economy Seat Capacity</label>
                        <input type="number" name="economyseat" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                    <div class="col-5 my-3">
                        <label for="exampleInputEmail1" class="form-label">Economy Class Price</label>
                        <input type="text" name="economyprice" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                    </div>
                </div>
            </div>
            <div class="" style="text-align: center;">
                <button name="btnsubmit" style="width: 18%;" type="submit" class="btn btn-primary">Add Flight</button>
            </div>
    </form>


    <!-- After submit button is clicked, insert the records to the flight table -->
    <?php

    if (isset($_POST['btnsubmit'])) {
        $result = mysqli_query($con, "INSERT INTO `flighttb` (`fid`, `fname`, `fsource`, `fdest`, `business_seat_capacity`, `business_price`, `firstclass_seat_capacity`, `firstclass_price`, `economy_seat_capacity`, `economy_price`) VALUES (NULL, '" . $_POST['fname'] . "', '" . $_POST['fsource'] . "', '" . $_POST['fdest'] . "', '" . $_POST['businessseat'] . "', '" . $_POST['businessprice'] . "', '" . $_POST['firstseat'] . "', '" . $_POST['firstprice'] . "', '" . $_POST['economyseat'] . "', '" . $_POST['economyprice'] . "');");

        if ($result) {
    ?>
            <script>
                let a = alert('New Flight added successfully!!');
                if (a || !a) {
                    window.location.assign('./Flights.php');
                }
            </script>
    <?php
        }
    }
    ?>

    <!-- Footer -->
    <?php include('../Components/Footer.php'); ?>

</body>

</html>