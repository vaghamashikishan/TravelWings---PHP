<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Index Page</title>
</head>

<body>
    <!-- Navbar -->
    <?php
    if (isset($_SESSION['pid'])) {
        include('../Components/Navbar_User.php');
    } else {
        include('../Components/Navbar_General.php');
    }
    ?>

    <!-- Carousel -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active" style="height: 92vh;">
                <img src="../Images//carousel(1).jfif" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Travel at your destination</h5>
                    <p>We'll help you to fly to your favourite place.</p>
                </div>
            </div>
            <div class="carousel-item" style="height: 92vh;">
                <img src="../Images//carousel(2).jfif" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Receive world class flight services</h5>
                    <p>You will be given world class flight services.</p>
                </div>
            </div>
            <div class="carousel-item" style="height: 92vh;">
                <img src="../Images//carousel(3).jfif" class="d-block w-100" alt="...">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Conveient process</h5>
                    <p>Simple apply few fliters and get the best suitable flight for your journey.</p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- Services - 3 circular obj in row -->
    <div id="services" class="container marketing my-3">
        <h1 class="" style="text-align: center;">Services that we offer</h1>
        <!-- Three columns of text below the carousel -->
        <div class="row my-3">
            <div class="col-lg-4">
                <img src="../Images//flight_img.jpg" class="bd-placeholder-img rounded-circle" width="140" height="140" alt="">
                <title>Placeholder</title>
                <h2 class="fw-normal">Affordable Flight</h2>
                <p>Find the best flight rates for you that falls in your budget.</p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img src="../Images//carousel(1).jfif" class="bd-placeholder-img rounded-circle" width="140" height="140" alt="">
                <title>Conveient Booking</title>
                </svg>

                <h2 class="fw-normal">Conveient Booking</h2>
                <p>It is really easy to book flight ticket and not as complicated as you think it is.</p>
            </div><!-- /.col-lg-4 -->
            <div class="col-lg-4">
                <img src="../Images//carousel(2).jfif" class="bd-placeholder-img rounded-circle" width="140" height="140" alt="">
                <title>Great Services</title>
                </svg>

                <h2 class="fw-normal">Great Services</h2>
                <p>Receive the best service to make your journey more pleasing and happy.</p>
            </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->
    </div>


    <hr class="featurette-divider">

    <!-- Photo and text side by side -->
    <div class="container marketing">
        <div class="row featurette">
            <div class="col-md-7" style="margin: auto;">
                <h2 class="featurette-heading fw-normal lh-1">Make your trip Amazing<h2>
                        <p class="lead">Let's travel to the places where you always wanted to go and here we'll help you to find the best flight option available for you. Travelling always make you feel relax and brings positivity.</p>
            </div>
            <div class="col-md-5">
                <img src="../Images//img(1).jfif" class="bd-placeholder-img bd-placeholder-img-lg featurette-image img-fluid mx-auto" alt="Flight image">
                <title>Placeholder</title>
            </div>
        </div>
    </div>

    <div class="my-3 text-center container">
        <h3 class="">Make your holiday a memorable one with us</h3>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
        </div>
    </div>

    <hr class="featurette-divider">

    <!-- Testimonial -->
    <h1 class="" id="testimonial" style="text-align: center;">Testimonials</h1>
    <div class="container" style="text-align: center; display: flex;">
        <div class="col-md-6" style="margin: 0 5% 0 0;">
            <div class="h-100 p-5 text-white bg-dark rounded-3">
                <h2>Akshay Patil<br></h2>
                <h4>8 June 2022</h4>
                <p>Dear Feedback team,

                    I would like to Thanks Mr Riyaz Shaikh in Go First who always very helpful and courteous...whenever I travelled he always help me.

                    I am frequent traveller with Go First and because of Riyaz Shaikh I will keep travelling with Go First in future.

                    On the Nagpur flight 142, I had an issue he came and took me directly to counter and given loader till aircraft... Very nice service.

                    Go First Rocks.</p>
            </div>
        </div>
        <div class="col-md-6" style="margin: 0 5% 0 0;">
            <div class="h-100 p-5 bg-light border rounded-3">
                <h2>Sanjay Patel<br></h2>
                <h4>28 March 2022</h4>
                <p>Hi Team Go First,
                    A big thank you for providing a delightful customer experience.

                    A big shout out and thank you to Pratik Yadav of Go First AMD team for walking that extra mile to ensure that I get my luggage which I missed at the AMD airport. Trust me you made me feel delighted and special.

                    Appreciate your efforts and kind help.

                    Regards,
                    B Sarawgi</p>
            </div>
        </div>
    </div>

    <hr class="featurette-divider">



    <!-- About Us -->
    <div id="about-us" class="px-4 text-center">
        <h1 class="">About Us</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
        </div>
    </div>



    <!-- Footer -->
    <?php include('../Components/Footer.php'); ?>
</body>

</html>