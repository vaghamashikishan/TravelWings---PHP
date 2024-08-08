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

    <title>Show Data</title>
</head>

<body>
    <!-- Navbar -->
    <?php include('../Components/Navbar_Admin.php'); ?>


    <!-- Container for displaying the user accounts details -->
    <div class="container my-3">
        <h2 style="text-align: center;">Accounts of the Users</h2>

        <!--Bootstrap Tables -->
        <table class="table my-3">
            <thead>
                <tr>
                    <th scope="col">Passenger Id</th>
                    <th scope="col">First name</th>
                    <th scope="col">Last name</th>
                    <th scope="col">Birthdate</th>
                    <th scope="col">Passport no</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Email</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $rows = mysqli_query($con, "select * from passengertb order by pid desc;");

                $affectedRows = mysqli_affected_rows($con);
                ?>

                <h6>Total Results : <?php echo $affectedRows; ?></h6>

                <!-- Display records -->
                <?php
                while ($row = mysqli_fetch_array($rows)) {
                    echo "<tr>
                    <th scope='row'>$row[0]</th>
                    <td>$row[1]</td>
                    <td>$row[2]</td>
                    <td>$row[3]</td>
                    <td>$row[4]</td>
                    <td>$row[5]</td>
                    <td>$row[6]</td>
                    <td><a href='delete.php?id=$row[0]'><button class='btn btn-sm btn-primary'>Delete Account</button></a></td>
                </tr>";
                }

                ?>
            </tbody>
        </table>
    </div>

    <!-- Footer -->
    <?php
    // include('../Components/Footer.php');
    ?>

    <!-- Footer -->
    <?php include('../Components/Footer.php'); ?>

</body>

</html>