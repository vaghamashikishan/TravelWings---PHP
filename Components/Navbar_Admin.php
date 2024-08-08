<!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="../AdminSide/showAccounts.php">AirTravel</a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" aria-current="page" href='../AdminSide/showAccounts.php'>Accounts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../AdminSide/ViewFeedbacks.php">Feedbacks</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Flights
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="../AdminSide/Flights.php">Show Available Flights</a></li>
                        <li><a class="dropdown-item" href="../AdminSide/View_Bookings.php">View Bookings</a></li>
                        <li><a class="dropdown-item" href="../AdminSide/AddFlight.php">Add New Flight</a></li>
                    </ul>
                </li>
            </ul>


            <!-- If admin have logged in then dislpay 'logout' button -->
            <form action="" method="post">
                <?php

                if (isset($_SESSION['admin'])) {
                    echo "<button name='logoutbtn' class='btn btn-sm btn-primary'>Log Out</button>";
                }
                if (isset($_POST['logoutbtn'])) {

                    session_unset();
                    session_destroy();

                ?>
                    <script>
                        let a = confirm("Logged out successfully!");
                        if (a || !a) {
                            window.location.assign("../UserSide/index.php");
                        }
                    </script>
                <?php
                }
                ?>
            </form>
        </div>
    </div>
</nav>