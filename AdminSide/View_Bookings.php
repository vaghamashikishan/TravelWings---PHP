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
    <title>View Bookings</title>
</head>

<body>
    <!-- Navbar -->
    <?php include('../Components/Navbar_Admin.php'); ?>

    <!-- Title -->
    <h1 style="text-align: center;">Bookings</h1>

    <!-- Search-Box -->
    <div class="container-fluid">
        Search : <input type="text" placeholder="Ticket id, pymt_id, pid, fname, fsource, fdest" id="search" onkeyup="searchfunc()" style="width: 25%; text-align: center;">
    </div>


    <!-- Show booking details in tabular form -->
    <table class="table" id="table1">
        <thead>
            <tr>
                <th scope="col">Ticket Id</th>
                <th scope="col">Passenger Id</th>
                <th scope="col">Flight Id</th>
                <th scope="col">Flight Name</th>
                <th scope="col">Source</th>
                <th scope="col">Destination</th>
                <th scope="col">Class</th>
                <th scope="col">Departure Date</th>
                <th scope="col">Payment Date</th>
                <th scope="col">Payment Amount</th>
                <th scope="col">Payment Id</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>

            <!-- Fetch The records from the tickettb -->
            <?php

            $result = mysqli_query($con, "Select * from tickettb order by tid desc");
            while ($row = mysqli_fetch_array($result)) {

                $tid = $row[0];
                $pid = $row[1];
                $fid = $row[2];
                $p_amt = $row[3];
                $p_date = $row[4];
                $departure_date = $row[5];
                $pymt_id = $row[8];
                $status = $row[9];
                $fclass = $row[6];

                $flight_details_fetched = mysqli_query($con, "select * from flighttb where fid = " . $fid);
                $flight_row = mysqli_fetch_array($flight_details_fetched);
                $fname = $flight_row[1];
                $fsource = $flight_row[2];
                $fdest = $flight_row[3];

            ?>

                <!-- Show Tickets -->
                <tr style="color: <?php echo $status != 'booked' ? 'red' : ''; ?>;">
                    <td scope="row"><?php echo $tid; ?></td>
                    <td><?php echo $pid; ?></td>
                    <td><?php echo $fid; ?></td>
                    <td><?php echo $fname; ?></td>
                    <td><?php echo $fsource; ?></td>
                    <td><?php echo $fdest; ?></td>
                    <td><?php echo $fclass; ?></td>
                    <td><?php echo $departure_date; ?></td>
                    <td><?php echo $p_date; ?></td>
                    <td><?php echo $p_amt; ?></td>
                    <td><?php echo $pymt_id; ?></td>
                    <td><?php echo $status; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <script>
        // Function for searching results
        const searchfunc = () => {
            search_value = document.getElementById('search').value.toUpperCase();

            table = document.getElementById('table1');
            tbody = document.getElementsByTagName('tbody')[0];

            tr = tbody.getElementsByTagName('tr');

            for (i = 0; i < tr.length; i++) {
                td_name = tr[i].getElementsByTagName('td');

                // console.log(td_name);

                // Search by fid, fname, fsource, fdest, pymt_id
                if ((td_name[0].innerHTML.toUpperCase().indexOf(search_value) > -1) ||
                    (td_name[1].innerHTML.toUpperCase().indexOf(search_value) > -1) ||
                    (td_name[3].innerHTML.toUpperCase().indexOf(search_value) > -1) ||
                    (td_name[4].innerHTML.toUpperCase().indexOf(search_value) > -1) ||
                    (td_name[5].innerHTML.toUpperCase().indexOf(search_value) > -1) ||
                    (td_name[6].innerHTML.toUpperCase().indexOf(search_value) > -1) ||
                    (td_name[10].innerHTML.toUpperCase().indexOf(search_value) > -1)) {

                    console.log(search_value);
                    tr[i].style.display = '';

                } else {
                    tr[i].style.display = 'none';
                }

            }
        }
    </script>

    <!-- Footer -->
    <?php include('../Components/Footer.php'); ?>
</body>

</html>