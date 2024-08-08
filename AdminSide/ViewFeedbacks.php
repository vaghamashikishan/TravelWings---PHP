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

    <link rel="stylesheet" href="font-awesome.min.css">
    <title>Feedbacks Details</title>
</head>

<body>
    <!-- Navbar -->
    <?php include('../Components/Navbar_Admin.php'); ?>

    <!-- Table for displaying customers feedbacks -->
    <div class="container">
        <div class="right-section">
            <h2 style="text-align: center; margin-top: 3%">Feedbacks Received</h2>

            <!--Bootstrap Tables -->
            <table class="table my-3">
                <thead>
                    <tr>
                        <th scope="col">PassengerId</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Date</th>
                        <th scope="col">Subject</th>
                        <th scope="col">Content</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rows = mysqli_query($con, "select feedbacktb.fdbackid, feedbacktb.pid, passengertb.fname, passengertb.email, feedbacktb.feedbackDate, feedbacktb.subject, feedbacktb.content from feedbacktb, passengertb where passengertb.pid=feedbacktb.pid order by feedbacktb.fdbackid desc;");

                    $affectedRows = mysqli_affected_rows($con);

                    ?>

                    <!-- Total Feedbacks  -->
                    <div class="" style="display: flex; justify-content: space-between;">
                        <h6>Total Feedbacks : <?php echo $affectedRows; ?></h6>
                        <a href='delete.php?deleteallfdback'><button class='btn btn-sm btn-primary'>Delete All Feedbacks</button></a>
                    </div>

                    <!-- Display feedbacks -->
                    <?php
                    while ($row = mysqli_fetch_array($rows)) {
                        echo "<tr>
            <th scope='row'>$row[1]</th>
            <td>$row[2]</td>
            <td>$row[3]</td>
            <td>$row[4]</td>
            <td>$row[5]</td>
            <td>$row[6]</td>
            <td><a href='delete.php?fdbackid=$row[0]'><button class='btn btn-sm btn-primary'>Delete</button></a></td>
        </tr>";
                    }

                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Footer -->
    <?php include('../Components/Footer.php'); ?>

</body>

</html>