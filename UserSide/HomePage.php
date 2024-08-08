<?php
session_start();

// Do not display this page if the user have not logged in
if (!$_SESSION['pid']) {
    header('location: ../Login.php');
}

include('../AdminSide/db.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
</head>

<body>
<?php

    

?>

</body>

</html>