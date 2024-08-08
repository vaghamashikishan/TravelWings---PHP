<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

</head>

<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #ccdbe7; position: sticky; top: 0; z-index: 1;">
        <div class="container-fluid">
            <a class="navbar-brand" href="./index.php">AirTravel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#services">Flight Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  active" href="#about-us">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  active" href="../UserSide/SearchFlights.php">Search Flights</a>
                    </li>
                </ul>
                <div class="d-flex" role="search" style="width: 14%; justify-content: space-evenly;" action="">
                    <a href="./Register.php"><button class="btn btn-outline-success" type="submit">Regiser</button></a>
                    <a href="../Login.php"><button class="btn btn-outline-success" type="submit">Login</button></a>
                </div>
            </div>
        </div>
    </nav>
</body>

</html>