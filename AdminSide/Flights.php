<?php

session_start();
include('../AdminSide/db.php');

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

    <title>Available Flights</title>

    <style>
        .filter_class {
            display: flex;
            margin-top: 3%;
            justify-content: space-around;
            align-items: center;
        }

        .common_source_dest {
            display: flex;
        }

        .filter_name {
            margin-right: 7%;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php include('../Components/Navbar_Admin.php'); ?>

    <!-- Flights -->
    <h2 style="text-align: center;">Available Flights</h2>

    <!-- Creation of Filters -->
    <form action="" method="POST" class="container-fluid filter_class">

        <!-- Departure Date -->
        <div class="common_source_dest">
            <div class="">Departure Date :<input type="date" min="<?php echo date('Y-m-d'); ?>" onchange="document.getElementById('btnshowall').click();" value="<?php echo isset($_POST['btnsearch']) || isset($_POST['btnshowall']) ? $_POST['departureDate'] : date('Y-m-d'); ?>" name="departureDate"></div>
        </div>

        <!-- Source -->
        <div class="common_source_dest">
            <div class="filter_name">Source</div>
            <select name="fsource" id="">

                <!-- Fetch sources cities and removes dulicate values and fill the dropdown menu -->
                <?php

                $rows = mysqli_query($con, "select * from flighttb");
                $ary = array();

                if ($rows) {
                    while ($row = mysqli_fetch_array($rows)) {

                        array_push($ary, $row[2]);
                    }

                    foreach (array_unique($ary) as $values) {
                ?>
                        <option value="<?php echo $values; ?>"><?php echo $values; ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>

        <!-- Destination -->
        <div class="common_source_dest">
            <div class="filter_name">Destiation</div>
            <select name="fdest" id="">

                <!-- Fetch sources cities and removes dulicate values and fill the dropdown menu -->
                <?php

                $rows = mysqli_query($con, "select * from flighttb");
                $ary = array();

                if ($rows) {
                    while ($row = mysqli_fetch_array($rows)) {

                        array_push($ary, $row[3]);
                    }

                    foreach (array_unique($ary) as $values) {
                ?>
                        <option value="<?php echo $values; ?>"><?php echo $values; ?></option>
                <?php
                    }
                }
                ?>
            </select>
        </div>

        <!-- Search button -->
        <div class="commom_source_dest">
            <button id="btnsearch" class="btn btn-sm btn-primary" name="btnsearch">Search</button>
            <button id="btnshowall" class="btn btn-sm btn-primary" name="btnshowall">Show all Flights</button>
        </div>
    </form>

    <!-- Search flight on button click -->
    <?php
    if (isset($_POST['btnsearch']) || isset($_POST['btnshowall'])) {
        // Increment as the flights are found available
        $total_available_flights = 0;

        $departureDate = $_POST['departureDate'];

        // When 'Search' button is clicked 
        if (isset($_POST['btnsearch'])) {
            $rows = mysqli_query($con, "select * from flighttb where fsource='" . $_POST['fsource'] . "' and fdest='" . $_POST['fdest'] . "';");
        }
        // When 'Show all Flights' button is clicked
        else {
            $rows = mysqli_query($con, "select * from flighttb;");
        }
    } else {
        // On first render(i.e., when no button is clicked at that time show all flights available on that day)
        $rows = mysqli_query($con, "select * from flighttb;");
        $departureDate = date('Y-m-d');
    }


    // If atleast one flight record is there according to the search filters then execute the below 'if' block
    if (mysqli_affected_rows($con) >= 1) {

        // Initializing used for the first render
        $total_available_flights = 0;
    ?>
        <!-- Display flight details -->
        <table class="table  my-3">

            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">Seats Available</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col">Price</th>
                    <th scope="col"></th>
                </tr>
                <tr>
                    <th scope="col">Flight ID</th>
                    <th scope="col">Flight Name</th>
                    <th scope="col">Source</th>
                    <th scope="col">Destination</th>
                    <th scope="col">First</th>
                    <th scope="col">Business</th>
                    <th scope="col">Economy</th>
                    <th scope="col">First Class</th>
                    <th scope="col">Business Class</th>
                    <th scope="col">Economy Class</th>
                </tr>
            </thead>
            <tbody>
                <!-- Fetch flight details from the database -->
                <?php while ($row = mysqli_fetch_array($rows)) {

                    // Values retrived from the table
                    {
                        $fid = $row[0];
                        $fname = $row[1];
                        $fsource = $row[2];
                        $fdest = $row[3];
                        $firstClasstotal = $row[4];
                        $businessClasstotal = $row[6];
                        $economyClasstotal = $row[8];
                        $seats_capacity = $firstClasstotal + $businessClasstotal + $economyClasstotal;  //Total seats : first class seats + business + economy
                        $firstClassfare = $row[5];
                        $businessClassfare = $row[7];
                        $economyClassfare = $row[9];
                    }

                    // To get the total number of booked seats on a particular date in a particular flight in FIRST CLASS
                    $fetched_row = mysqli_query($con, "select count(*) from tickettb where fid = " . $fid . " and Departure_Date = '" . $departureDate . "' and status='booked' and classtype='first';");
                    $result = mysqli_fetch_array($fetched_row);
                    $totalBooked_firstClass = $result[0];

                    // To get the total number of booked seats on a particular date in a particular flight in BUSINESS CLASS
                    $fetched_row = mysqli_query($con, "select count(*) from tickettb where fid = " . $fid . " and Departure_Date = '" . $departureDate . "' and status='booked' and classtype='business';");
                    $result = mysqli_fetch_array($fetched_row);
                    $totalBooked_Business = $result[0];

                    // To get the total number of booked seats on a particular date in a particular flight in ECONOMY CLASS
                    $fetched_row = mysqli_query($con, "select count(*) from tickettb where fid = " . $fid . " and Departure_Date = '" . $departureDate . "' and status='booked' and classtype='economy';");
                    $result = mysqli_fetch_array($fetched_row);
                    $totalBooked_Economy = $result[0];

                    $totalBooked_Seats = $totalBooked_firstClass + $totalBooked_Business + $totalBooked_Economy;
                    // If atleaat one seat of any class is available then add it to the total availabl flights count
                    if ($totalBooked_Seats < $seats_capacity) {
                        $total_available_flights += 1;
                    }
                ?>
                    <!-- Display the flight details available for booking -->
                    <tr style="color: <?php echo ($seats_capacity - $totalBooked_Seats) == 0 ? 'red' : ''; ?>">
                        <th scope="row"><?php echo $fid; ?></th>
                        <td><?php echo $fname; ?></td>
                        <td><?php echo $fsource; ?></td>
                        <td><?php echo $fdest; ?></td>


                        <!-- Available First Class seats -->
                        <td style="color: <?php echo ($firstClasstotal - $totalBooked_firstClass) == 0 ? "red" : "black"; ?>"><?php echo $firstClasstotal - $totalBooked_firstClass; ?></td>
                        <!-- Available Business Class seats -->
                        <td style="color: <?php echo ($businessClasstotal - $totalBooked_Business) == 0 ? "red" : "black"; ?>"><?php echo $businessClasstotal - $totalBooked_Business; ?></td>
                        <!-- Available Economy Class seats -->
                        <td style="color: <?php echo ($economyClasstotal - $totalBooked_Economy) == 0 ? "red" : "black"; ?>"><?php echo $economyClasstotal - $totalBooked_Economy; ?></td>

                        <!-- Show price of each flight class -->
                        <td><?php echo $firstClassfare; ?></td>
                        <td><?php echo $businessClassfare; ?></td>
                        <td><?php echo $economyClassfare; ?></td>



                    </tr>
                <?php
                } ?>
            </tbody>

        </table>

    <?php
    } else {
        /* IF no records are there for the applied filters */
        /* IF source and destination are the same */
        if ($_POST['fsource'] == $_POST['fdest']) {
            echo "<script>alert('Source and Destination cannot be same!!');</script>";
        }
        /* IF no flights are available for the applied fliters */
        if ($total_available_flights == 0) {
            echo "<script>alert('We are sorry but this flight is not available );');</script>";
        }
    }
    ?>

    </table>


    <!-- Show total available number of flights on the selected date -->
    <div class="" style="font-weight: 600;">Total Available Flights for Booking on
        <?php
        echo  isset($_POST['btnsearch']) || isset($_POST['btnshowall']) ? $_POST['departureDate'] : date('Y-M-d');
        echo " : ";
        echo $total_available_flights == 0 ? 0 : $total_available_flights;
        ?>
    </div>

    <!-- Footer -->
    <?php include('../Components/Footer.php'); ?>
</body>

</html>