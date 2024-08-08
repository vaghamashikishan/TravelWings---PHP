<?php
session_start();

// Do not display this page if the user have not logged in
if (!$_SESSION['pid'] || !$_SESSION['fid']) {
    header('location: ./index.php');
}

include('../AdminSide/db.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Payment Page</title>
    <style>
        * {
            margin: 0%;
            padding: 0%;
        }

        .info_text {
            font-size: 121%;
            font-weight: 500;
        }
    </style>
</head>

<body>

    <?php include('../Components/Navbar_User.php'); ?>

    <?php if (!isset($_POST['hidden'])) { ?>
        <div class="info_text" style="color: red;">Click the 'Pay with RazorPay' button to make the payment</div>
    <?php }else{ ?>
        <div class="info_text" style="color: green;">Go to 'My Ticket' section to download your ticket ;) </div>
    <?php } ?>


    <!-- PAYMENT BY RAZOR PAY -->
    <?php

    include('../Razorpay/razorpay-php/razorpay-php/Razorpay.php');

    use Razorpay\Api\Api;

    $key_id = "rzp_test_gL9C8CXIvKQjVI";
    $secret = "OC9N4l91ACfnsUIAbXGYsW7C";


    // Creating order
    $api = new Api($key_id, $secret);
    $order = $api->order->create(array('receipt' => '123', 'amount' => $_SESSION['price'] * 100, 'currency' => 'INR'));
    ?>


    <!-- 'Pay with Razorpay' button -->
    <!-- After successful payment rediret to this same page but don't show the paymen button -->
    <?php if (!isset($_POST['hidden'])) { ?>
        <form action="" method="POST">
            <script src="https://checkout.razorpay.com/v1/checkout.js" data-key="<?php echo $key_id; ?>" data-amount="<?php echo $_SESSION['price'] * 100; ?>" data-currency="INR" data-order_id="<?php echo $order->id ?>" data-buttontext="Pay with Razorpay" data-name="AirTravel Payment" data-description="Payment to AirTravel for Ticket booking" data-image="https://example.com/your_logo.jpg" data-prefill. name="" data-prefill.email="" data-theme.color="#F37254">
            </script>

            <input type="hidden" custom="Hidden Element" name="hidden" id="hidden">
        </form>
    <?php } ?>

    <!-- After successful payment, insert the records to the database, update the seats availability of the flight and send the booking confirmation mail -->
    <?php
    if (isset($_POST['hidden'])) {

        // Payment Id received after successful payment
        $pymt_id  = $_POST['razorpay_payment_id'];

        // Insert into ticket table
        $result = mysqli_query($con, "INSERT INTO `tickettb` (`tid`, `pid`, `fid`, `pamt`, `pdate`, `Departure_Date` ,`classtype`, `foodtype`, `pymt_id`,`status`) VALUES (NULL, '" . $_SESSION['pid'] . "', '" . $_SESSION['fid'] . "', '" . $_SESSION['price'] . "', current_timestamp(), '" . $_SESSION['departureDate'] . "' ,'" . $_SESSION['flight_class'] . "', '" . $_SESSION['flight_food'] . "', '" . $pymt_id . "','booked');");

        // If record successfully inserted to the database
        if ($result) {
            echo "<script>
            alert('Ticket booked Successfully!! Download it from the `My Ticket` section.');
            </script>";

            // Send booking confirmation Mail
            $passenger_detail = mysqli_query($con, 'select email from passengertb where pid = ' . $_SESSION['pid']);
            $passenger_detail_row = mysqli_fetch_array($passenger_detail);
            $passenger_email = $passenger_detail_row[0];
            $msg = "Thank you for booking ticket with us ;) \n
            You can download it from the `My Ticket` section. \n
            For any queries, visit www.airtravel.com or make a call to 000001324
            \n Have a happy and safe journey ;)";

            // IF mail sent successfully, show alert() to the user for the same
            if (mail($passenger_email, 'AirTravel Flight Booking Confirmation', $msg)) {
                echo "<script>alert('Confirmation mail has been sent to your registered email !!');</script>";
            }
        }
    }
    ?>

</body>

</html>