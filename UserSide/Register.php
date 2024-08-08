<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <title>Register</title>

    <style>
        .title {
            text-align: center;
            display: block;
            font-size: 33px;
            margin-top: 1%;
        }

        .field {
            margin: 2%;
            text-align: center;
        }

        .submit_btn_class {
            text-align: center;
            margin-left: -29%;
        }
    </style>
</head>

<body>

    <section class="h-100 bg-light">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card card-registration my-4">
                        <div class="row g-0">
                            <div class="col-xl-6 d-none d-xl-block">
                                <img src="../Images//registration_img.jfif" alt="Sample photo" class="img-fluid" style="border-top-left-radius: .25rem; border-bottom-left-radius: .25rem;" />
                            </div>
                            <div class="col-xl-6">
                                <div class="card-body p-md-5 text-black">
                                    <div class="" style="margin-bottom: 3%; display: flex; align-items: center; justify-content: center;">
                                        <h2 style="text-align: center; text-decoration: underline;">AirTravel
                                            - Flight Booking Platform</h2>
                                    </div>
                                    <h3 class="mb-5 text-uppercase" style="text-align: center;">Registration Form</h3>

                                    <!-- Form -->
                                    <form action="" method="post">
                                        <div class="row">
                                            <!-- First Name -->
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <input required name="fname" type="text" id="form3Example1m" class="form-control form-control-lg" />
                                                    <label class="form-label" for="form3Example1m">First name</label>
                                                </div>
                                            </div>

                                            <!-- Last Name -->
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <input required name="lname" type="text" id="form3Example1n" class="form-control form-control-lg" />
                                                    <label class="form-label" for="form3Example1n">Last name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- Email -->
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <input required name="email" type="email" id="form3Example1m1" class="form-control form-control-lg" />
                                                    <label class="form-label" for="form3Example1m1">Email</label>
                                                </div>
                                            </div>

                                            <!-- Passport No -->
                                            <div class="col-md-6 mb-4">
                                                <div class="form-outline">
                                                    <input required name="passportno" type="text" id="form3Example1n1" class="form-control form-control-lg" />
                                                    <label class="form-label" for="form3Example1n1">Passport No.</label>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Gender -->
                                        <div class="form-outline mb-4">
                                            <!-- <input required name="gender" type="text" id="form3Example8" class="form-control form-control-lg" /> -->
                                            <div class="">
                                                <input type="radio" name="gender" id="" value="Male" checked><span style="margin-right: 5%;">Male</span>
                                                <input type="radio" name="gender" id="" value="Female"><span style="margin-right: 5%;">Female</span>
                                                <input type="radio" name="gender" id="" value="Other"><span style="margin-right: 5%;">Other</span>
                                            </div>
                                            <label class="form-label" for="form3Example8">Gender</label>
                                        </div>

                                        <!-- Birthdate -->
                                        <div class="form-outline mb-4">
                                            <input required name="bdate" type="date" id="form3Example8" max="<?php echo date('Y-m-d'); ?>" class="form-control form-control-lg" />
                                            <label class="form-label" for="form3Example8">Birthdate</label>
                                        </div>

                                        <!-- Password -->
                                        <div class="form-outline mb-4">
                                            <input required name="password" type="text" id="form3Example8" class="form-control form-control-lg" />
                                            <label class="form-label" for="form3Example8">Password</label>
                                        </div>

                                        <!-- Confirm Password -->
                                        <div class="form-outline mb-4">
                                            <input required name="confirmpassword" type="password" id="form3Example8" class="form-control form-control-lg" />
                                            <label class="form-label" for="form3Example8">Confirm Password</label>
                                        </div>

                                        <!-- Create Account Button -->
                                        <div class="d-flex justify-content-end pt-3">
                                            <button type="submit" name="btnsubmit" class="btn btn-success btn-lg ms-2">Create Account</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php

    /* Check Validation and create account(insert record to passengertb and logintb ) */
    if (isset($_POST['btnsubmit'])) {

        if ($_POST['password'] == $_POST['confirmpassword']) {

            include('../AdminSide/db.php');

            // Insert record of newly created user's account
            $result = mysqli_query($con, "INSERT INTO `passengertb` (`pid`, `fname`, `lname`, `bdate`, `passportno`, `gender`, `email`, `pass`) VALUES (NULL, '" . $_POST['fname'] . "', '" . $_POST['lname'] . "', '" . $_POST['bdate'] . "', '" . $_POST['passportno'] . "', '" . $_POST['gender'] . "', '" . $_POST['email'] . "', '" . $_POST['password'] . "');");

            // Query executed successfully
            if ($result) {

                $msg = "Thank you creating an account with AirTravel \n 
                We would love to serve you ;)  \n
                You email : " . $_POST['email'] . " password : " . $_POST['password'] . "";

                $sent = mail($_POST['email'], 'Account Creation', $msg);

                echo "<script>
                    alert('Account created successfully!! Corresponding mail have been sent to you!');
                    window.location.assign('./index.php');
                    </script>";
            } else {
                echo "<script>alert('Failed creating account!!' );</script>";
            }
        } else {
            echo "<script>
                let a = confirm('Incorrect details or password did not matched with confirm password!!');
                if (a || !a) {
                    window.location.assign('Register.php');
                }
            </script>";
        }
    }

    ?>

</body>

</html>