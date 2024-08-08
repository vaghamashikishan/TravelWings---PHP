<?php
session_start();

// Do not display this page if the user have not logged in
if (!$_SESSION['pid']) {
    header('location: ./index.php');
}
$fid = $_GET['fid'];
$_SESSION['departureDate'] = $_GET['departureDate'];
$departureDate = $_SESSION['departureDate'];
$_SESSION['fid'] = $fid;

include('../AdminSide/db.php');


// Retriving the data of the flight
$rows = mysqli_query($con, "select * from flighttb where fid=" . $_SESSION['fid']);
$row = mysqli_fetch_array($rows);

$business_price = $row[5];
$firstclas_price = $row[7];
$economy_price = $row[9];

// Storing price in the session variable only aftet the nay one button is clicked
if (isset($_POST['btncheckprice']) || isset($_POST['btnproceed'])) {

    if ($_POST['flight_class'] == 'first') {
        $_SESSION['price'] = $firstclas_price;
    } else {
        if ($_POST['flight_class'] == 'business') {
            $_SESSION['price'] = $business_price;
        } else if ($_POST['flight_class'] == 'economy') {
            $_SESSION['price'] = $economy_price;
        }
    }
    // Changing the price and class html text
    echo "<script>
            document.getElementById('amountTxt').innerHTML = " . $_SESSION['price'] . "
            alert('" . $_SESSION['price'] . "');
        </script>";
}

// Checking the total booked seats in all flight clas
$fetched_row = mysqli_query($con, "select count(*) from tickettb where fid = " . $fid . " and Departure_Date = '" . $departureDate . "' and status='booked' and classtype='first';");
$result = mysqli_fetch_array($fetched_row);
$totalBooked_firstClass = $result[0];

$fetched_row = mysqli_query($con, "select count(*) from tickettb where fid = " . $fid . " and Departure_Date = '" . $departureDate . "' and status='booked' and classtype='business';");
$result = mysqli_fetch_array($fetched_row);
$totalBooked_businessClass = $result[0];

$fetched_row = mysqli_query($con, "select count(*) from tickettb where fid = " . $fid . " and Departure_Date = '" . $departureDate . "' and status='booked' and classtype='economy';");
$result = mysqli_fetch_array($fetched_row);
$totalBooked_economyClass = $result[0];

// Retriving the seat capacity of each class of the flight
$rows = mysqli_query($con, "select firstclass_seat_capacity, business_seat_capacity, economy_seat_capacity from flighttb where fid = " . $fid . ";");
$row = mysqli_fetch_array($rows);

$firstclass_capacity = $row[0];
$business_capacity = $row[1];
$economy_capacity = $row[2];


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Document</title>

    <style>
        .designClassBody {
            background: url("../Images/carousel(3).jfif");
            background-color: #eaf2ff;
            background-size: cover;
        }

        .title {
            text-align: center;
            display: block;
            font-size: 33px;
            margin: 1% 0% 2% 0%;
        }

        .field {
            margin: 1%;
            text-align: center;
        }

        .submit_btn_class {
            text-align: center;
            margin-left: -29%;
        }

        input {
            color: #9f9696;
        }

        .payment_txt {
            text-align: center;
            font-size: 133%;
            font-weight: 700;
        }

        .confirm_txt {
            text-align: center;
            color: red;
        }
    </style>
</head>

<body>
    <div class="designClassBody">
        <!-- Navbbar.php -->
        <?php include('../Components/Navbar_User.php'); ?>


        <!-- Fetch passenger data from passengertb and flighttb -->
        <?php
        $result = mysqli_query($con, "select passengertb.fname, passengertb.bdate, passengertb.passportno, passengertb.email, flighttb.fid, flighttb.fname, flighttb.fsource, flighttb.fdest from passengertb, flighttb where passengertb.pid=" . $_SESSION['pid'] . " and flighttb.fid=" . $_SESSION['fid'] . ";");
        if ($result) {
            $data = mysqli_fetch_array($result);
        } else {
            echo "<script>alert('Unexpected error occured ); Try again!!');</>";
        }

        ?>

        <span class="title">Booking Details</span>

        <!-- Show msg to confirm the data when user clicks "proceed to booking"-->
        <?php if (isset($_POST['btnproceed'])) {
            echo "<span style='
        color: red;
        display: block;
        text-align: center;
        margin-bottom: 2%;
        font-size: 118%;'>
            Please verify all the details before making payment
        </span>";
        } ?>

        <!-- Form to display the passengers details and the flight details they wished to travel through -->
        <form method="POST" class="container" action="">
            <!-- First Name -->
            <div class="field row">
                <span class="col-3">First Name</span>
                <input class="col-3" type="text" readonly value="<?php echo $data[0]; ?>">
            </div>

            <!--Birhtdate -->
            <div class="field row">
                <span class="col-3">Birthdate</span>
                <input class="col-3" type="Date" readonly value="<?php echo $data[1]; ?>">
            </div>

            <!--Passport No -->
            <div class="field row">
                <span class="col-3">Passport No.</span>
                <input class="col-3" type="text" readonly value="<?php echo $data[2]; ?>">
            </div>

            <!-- Email -->
            <div class="field row">
                <span class="col-3">Email</span>
                <input class="col-3" type="email" readonly value="<?php echo $data[3]; ?>">
            </div>

            <!-- Flight ID -->
            <div class="field row">
                <span class="col-3">Flight ID</span>
                <input class="col-3" type="email" readonly value="<?php echo $data[4]; ?>">
            </div>

            <!-- Flight Name -->
            <div class="field row">
                <span class="col-3">Flight Name</span>
                <input class="col-3" type="email" readonly value="<?php echo $data[5]; ?>">
            </div>

            <!-- Departure Date -->
            <div class="field row">
                <span class="col-3">Departure Date</span>
                <input class="col-3" type="date" readonly value="<?php echo $departureDate; ?>">
            </div>

            <!-- Source -->
            <div class="field row">
                <span class="col-3">Source</span>
                <input class="col-3" type="email" readonly value="<?php echo $data[6]; ?>">
            </div>

            <!-- Destination -->
            <div class="field row">
                <span class="col-3">Destination</span>
                <input class="col-3" type="email" readonly value="<?php echo $data[7]; ?>">
            </div>

            <!-- Food -->
            <div class="field row">
                <span class="col-3">Food</span>
                <select style="width: 25%;" name="flight_food" class="" id="" <?php if (isset($_POST['btnproceed'])) {
                                                                                    echo "disabled";
                                                                                    $_SESSION['flight_food'] = $_POST['flight_food'];
                                                                                } ?>>
                    <option value="veg" <?php if (isset($_POST['flight_food'])) {
                                            if ($_POST['flight_food'] == 'veg') {
                                                echo "selected";
                                            }
                                        } ?>>Vegetarian</option>
                    <option value="nonveg" <?php if (isset($_POST['flight_food'])) {
                                                if ($_POST['flight_food'] == 'nonveg') {
                                                    echo "selected";
                                                }
                                            } ?>>Non-Vegetarian</option>
                </select>
                <span class="col-1" style="color: red; padding: 0 6px; text-align: left;">*</span>
            </div>

            <!-- Flight Class -->
            <div class="field row">
                <span class="col-3">Available Flight Class</span>
                <select style="width: 25%;" name="flight_class" class="" id="selectClassDropDown" <?php if (isset($_POST['btnproceed'])) {
                                                                                                        echo "disabled";
                                                                                                        $_SESSION['flight_class'] = $_POST['flight_class'];
                                                                                                    } ?>>

                    <!-- Show the below 'Option' only if the booked number of seats are less than the total seat capacity of the particularclass -->

                    <?php if ($totalBooked_firstClass < $firstclass_capacity) { ?>

                        <option value="first" <?php if (isset($_POST['flight_class'])) {
                                                    if ($_POST['flight_class'] == 'first') {
                                                        echo "selected";
                                                    }
                                                } ?>>First</option>
                    <?php } ?>

                    <?php if ($totalBooked_businessClass < $business_capacity) { ?>
                        <option value="business" <?php if (isset($_POST['flight_class'])) {
                                                        if ($_POST['flight_class'] == 'business') {
                                                            echo "selected";
                                                        }
                                                    } ?>>Business</option>
                    <?php } ?>

                    <?php if ($totalBooked_economyClass < $economy_capacity) { ?>
                        <option value="economy" <?php if (isset($_POST['flight_class'])) {
                                                    if ($_POST['flight_class'] == 'economy') {
                                                        echo "selected";
                                                    }
                                                } ?>>Economy</option>
                    <?php } ?>

                </select>
                <span class="col-1" style="color: red; padding: 0 6px; text-align: left;">*</span>
            </div>

            <!-- Text msg to select food and fight class -->
            <div class="" style="color: red; padding-left: 19%;  visibility : <?php echo isset($_POST['btnproceed']) ? "hidden" : "visible"; ?>">
                Please select food and flight Class before proceeding to booking
            </div>

            <!-- Display Amount Payable -->
            <div class="" style="font-size: 135%; color: green; padding-left: 19%; visibility : <?php echo isset($_POST['btnproceed']) || isset($_POST['btncheckprice']) ? "visible" : "hidden"; ?>">
                <?php echo isset($_POST['btncheckprice']) || isset($_POST['btnproceed']) ? "Amount Payable for " . $_POST['flight_class'] : "" ?> Class :
                <span id="amountTxt"><?php echo isset($_POST['btncheckprice']) || isset($_POST['btnproceed']) ? $_SESSION['price']  :       $firstclas_price; ?>
                </span>
            </div>

            <div style="display: flex; justify-content: center; margin-top: 1%;">
                <!-- Proceed to booking button -->
                <div class="submit_btn_class">
                    <button type="submit" name="btnproceed" class="btn btn-primary" style="visibility : <?php echo isset($_POST['btnproceed']) ? "hidden" : "visible"; ?>">Proceed to Booking</button>
                </div>
                <!-- Check Price button -->
                <div class="submit_btn_class">
                    <button type="submit" name="btncheckprice" class="btn btn-primary" style="visibility : <?php echo isset($_POST['btnproceed']) ? "hidden" : "visible"; ?>">Check Price</button>
                </div>
            </div>
        </form>

        <!-- Form for 'Make Payment' button-->
        <form action="Payment.php" method="POST">
            <!-- Make Payment -->
            <div class="submit_btn_class">
                <button type="submit" name="btnpayment" class="btn btn-primary" style="visibility : <?php echo isset($_POST['btnproceed']) ? "visible" : "hidden"; ?>">Make Payment</button>
            </div>
        </form>

    </div>
    <!-- Footer -->
    <?php include('../Components/Footer.php'); ?>
</body>

</html>