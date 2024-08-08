<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar-User</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg" style="background-color: #ccdbe7; position: sticky; top: 0; z-index: 1;">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">AirTravel</a>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./Profile.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="./SearchFlights.php">Book Flight</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="./MyTicket.php">My Ticket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="./Feedback.php">Provide Feedback</a>
                    </li>
                </ul>


                <!-- If user have logged in then dislpay 'logout' button -->
                <form action="" method="post">
                    <?php

                    if (isset($_SESSION['pid'])) {
                        echo "<button name='logoutbtn' class='btn btn-sm btn-primary'>Log Out</button>";
                    }
                    if (isset($_POST['logoutbtn'])) {

                        session_unset();
                        session_destroy();

                    ?>

                        <script>
                            let a = confirm("Logged out successfully!");
                            if (a || !a) {
                                window.location.assign("./index.php");
                            }
                        </script>
                    <?php
                    }
                    ?>
                </form>
            </div>
        </div>
    </nav>
</body>

</html>