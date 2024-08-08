<?php
session_start();

// Do not display this page if the user have not logged in
if (!isset($_GET['tid'])) {
    header('location: ./index.php');
}

// Fetch the ticketid received from the 'MyTicket.php' page by clicking on 'cancel Booking' button
$tid = $_GET['tid'];

include('../AdminSide/db.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Booking</title>

    <!-- Script code to prevent from coming back to this page i.e, diabling back button of browser for this page -->
    <script type="text/javascript">
        // window.history.forward();
    </script>
</head>



<body>
    <?php
    // Include the Navbar
    include('../Components/Navbar_User.php');
    ?>

    <form action="" method="post" style="text-align: center;">
        <h2>Are you sure want to cancel your booking?</h2>
        <div class="">
            <button style="font-size: 106%; width: 7%;" class="btn btn-sm btn-danger" type="submit" name="yesbtn">Yes</button>
            <button style="font-size: 106%; width: 7%;" class="btn btn-sm btn-primary" type="submit" name="nobtn">No</button>
        </div>
    </form>

    <?php

    // IF the user clicks on the 'yes' button then cancel the booking, update the flight seats, booking status
    if (isset($_POST['yesbtn'])) {

        // Update the booking status in ticlettb
        $status_change_query = mysqli_query($con, "update tickettb set status='cancelled' where tid = " . $tid);

        if ($status_change_query ) {
            echo "<script>
            let a = confirm('Your booking has been cancelled successuflly!!');
            if(a || !a)
            {
                window.location.assign('MyTicket.php');
            } 
            </script>";
        }
    }

    // If the user clicks on the 'No' button then show confirm that the booking has not been cancelled and redirect back to the MyTicket.php page
    if (isset($_POST['nobtn'])) {

        echo "<script>
            let a = confirm('Your booking has NOT been cancelled yet!!');
            if (a || !a) {
                window.location.assign('MyTicket.php');
            }
        </script>";
    }
    ?>

    <!-- Footer -->
    <?php include('../Components/Footer.php'); ?>

</body>

</html>