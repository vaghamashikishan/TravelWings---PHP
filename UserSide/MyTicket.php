<?php
session_start();

// Do not display this page if the user have not logged in
if (!$_SESSION['pid']) {
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
    <title>My Tickets</title>
</head>

<body>
    <?php include('../Components/Navbar_User.php'); ?>

    <div style="padding-top: 1%;
    font-size: 200%;
    text-align: center;
    font-weight: 400;">My Tickets</div>

    <!-- Displaying Ticket details in tabular form -->

    <table class="table table-striped my-3" style="margin-bottom: 7%;">

        <thead>
            <tr>
                <th scope="col">Booking Date</th>
                <th scope="col">Departure Date</th>
                <th scope="col">Payment Amount</th>
                <th scope="col">Source</th>
                <th scope="col">Destinantion</th>
                <th scope="col">Actions</th>
                <th scope="col">Status</th>
            </tr>
        </thead>

        <tbody>
            <!-- Fetch ticket details and source and destination from the database -->
            <?php
            $tickets = mysqli_query($con, "select pdate,pamt,fid,tid,pdate,status,Departure_Date from tickettb where pid=" . $_SESSION['pid'] . " order by tid desc;");


            while ($ticketrow = mysqli_fetch_array($tickets)) {

                $pdate = $ticketrow[0];
                $pamt = $ticketrow[1];
                $fid = $ticketrow[2];
                $tid = $ticketrow[3];
                $pdate = $ticketrow[4];
                $status = $ticketrow[5];
                $departureDate = $ticketrow[6];

                $flightrow = mysqli_query($con, "select fsource,fdest from flighttb where fid=" . $fid . ";");
                $flightrow = mysqli_fetch_array($flightrow);
            ?>
                <tr>
                    <!-- Booking Date -->
                    <th scope="row"><?php echo $pdate; ?></th>
                    
                    <!-- Departure Date -->
                    <th scope="row"><?php echo $departureDate; ?></th>

                    <td><?php echo $pamt; ?></td>
                    <td><?php echo $flightrow[0]; ?></td>
                    <td><?php echo $flightrow[1]; ?></td>

                    <!-- Action buttons -->
                    <td>
                        <a href='Receipt.php?tid=<?php echo $tid; ?>' target="">
                            <button class="btn btn-sm btn-primary mx-2">Download Receipt</button>
                        </a>
                        <!-- Cancel Booking button -->
                        <a href="Cancel_Booking.php?tid=<?php echo $tid; ?>">
                            <button style="display: <?php if ($status == 'cancelled') {
                                                            echo 'none';
                                                        } else {
                                                            echo 'inline';
                                                        } ?>;" class="btn btn-sm btn-warning mx-2">Cancel Booking</button>
                        </a>
                    </td>
                    <!-- Status -->
                    <td style="color: <?php echo $status == 'booked' ? 'green' : 'red'; ?>;"><?php echo $status == 'booked' ? 'Booked' : 'Cancelled'; ?></td>
                </tr>
            <?php } ?>

        </tbody>
    </table>

    <!-- Footer -->
    <?php include('../Components/Footer.php'); ?>

</body>

</html>