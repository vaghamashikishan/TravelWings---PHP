
<?php
session_start();

// Do not display this page if the user have not logged in AND clicked on 'Downnload Ticket' button !!
// Received from the 'My Ticket' page, 'Download Receipt' button click

if (!isset($_GET['tid'])) {
    header('location: ./index.php');
}

$tid = $_GET['tid'];

include('../AdminSide/db.php');
require_once('../pdf_Library/vendor/autoload.php');

// Fetching details from the tickettb
$ticket = mysqli_query($con, 'select fid,classtype,foodtype,pid,pymt_id,pdate,status,Departure_Date from tickettb where tid=' . $tid . ';');
$ticket_details = mysqli_fetch_array($ticket);

$fid = $ticket_details[0];
$flight_class = $ticket_details[1];
$flight_food = $ticket_details[2];
$pid = $ticket_details[3];
$pymet_id = $ticket_details[4];
$pdate = $ticket_details[5];
$status = $ticket_details[6];
$departureDate = $ticket_details[7];

$start_date = $pdate;  
$date = strtotime($start_date);
$date = strtotime("+1 day", $date);

// Passenger details
$passenger_details = mysqli_query($con, 'select * from passengertb where pid=' . $pid . ';');
$passenger_row = mysqli_fetch_array($passenger_details);

$fname = $passenger_row[1];
$bdate = $passenger_row[3];
$passportno = $passenger_row[4];


// Flight details
$flight_details = mysqli_query($con, 'select * from flighttb where fid=' . $fid . ';');
$flight_row = mysqli_fetch_array($flight_details);



// Html code for the pdf
$html = "

<html>

<head>
     <title>Payment Receipt</title>
</head>

<body>

    <div class='container-fluid' style='border: 2px solid black; text-align: center; background: #d6d2d9;'>

        <div class='' style='font-size: 200%; font-weight: 800; padding: 2%;'>AirTravel Ticket</div>";



if ($status == 'cancelled') {
    $html .= "<div class='' style='font-size: 150%; font-weight: 800; padding: 2%; color: Red'>Booking Cancellation Receipt</div>";
}



$html .= "<!-- Ticket Id -->
        <div class='row' style='padding: 1%;'>
            <span class='col-md-3' style='font-weight: bold;'>Ticket Id</span>
            <span class='col-md-3' style='font-weight: bold;'>:</span>
            <span class='' style=''> " . $tid . "</span>
        </div>

        <!-- Departure Date -->
        <div class='row' style='padding: 1%;'>
            <span class='col-md-3' style='font-weight: bold;'>Departure Date</span>
            <span class='col-md-3' style='font-weight: bold;'>:</span>
            <span class='' style=''> " . $departureDate . "</span>
        </div>

        <!-- Name -->
        <div class='row' style='padding: 1%;'>
            <span class='col-md-3' style='font-weight: bold;'>Name</span>
            <span class='col-md-3' style='font-weight: bold;'>:</span>
            <span class='' style=''> " . $fname . "</span>
        </div>

        <!-- Passport No -->
        <div class='row' style='padding: 1%;'>
            <span class='col-md-3' style='font-weight: bold;'>Passport No</span>
            <span class='col-md-3' style='font-weight: bold;'>:</span>
            <span class='' style=''> " . $passportno . "</span>
        </div>

        <!-- Birthdate -->
        <div class='row' style='padding: 1%;'>
            <span class='col-md-3' style='font-weight: bold;'>Birthdate</span>
            <span class='col-md-3' style='font-weight: bold;'>:</span>
            <span class='' style=''> " . $bdate . "</span>
        </div>

        <!-- Flight Name -->
        <div class='row' style='padding: 1%;'>
            <span class='col-md-3' style='font-weight: bold;'>Flight Name </span>
            <span class='col-md-3' style='font-weight: bold;'>:</span>
            <span class='' style=''> " . $flight_row[1] . "</span>
        </div>

       
        <!-- Source -->
        <div class='row' style='padding: 1%;'>
            <span class='col-md-3' style='font-weight: bold;'>Source</span>
            <span class='col-md-3' style='font-weight: bold;'>:</span>
            <span class='' style=''> " . $flight_row[2] . "</span>
        </div>

        <!-- Destination -->
        <div class='row' style='padding: 1%;'>
            <span class='col-md-3' style='font-weight: bold;'>Destination</span>
            <span class='col-md-3' style='font-weight: bold;'>:</span>
            <span class='' style=''> " . $flight_row[3] . "</span>
        </div>
        
        <!-- Flight Class -->
        <div class='row' style='padding: 1%;'>
            <span class='col-md-3' style='font-weight: bold;'>Flight Class</span>
            <span class='col-md-3' style='font-weight: bold;'>:</span>
            <span class='' style=''> " . $flight_class . "</span>
        </div>

        <!-- Flight Food -->
        <div class='row' style='padding: 1%;'>
            <span class='col-md-3' style='font-weight: bold;'>Flight Food</span>
            <span class='col-md-3' style='font-weight: bold;'>:</span>
            <span class='' style=''> " . $flight_food . "</span>
        </div>

        <!-- Amount -->
        <div class='row' style='padding: 1%;'>
            <span class='col-md-3' style='font-weight: bold;'>Payment amount : </span>
            <span class='' style=''> " . $flight_row[5] . "</span>
            <span class='' style='color: green;'>Paid Successfully!!</span>
        </div>

        <!-- Payment Id -->
        <div class='row' style='padding: 1%;'>
            <span class='col-md-3' style='font-weight: bold;'>Payment Id : </span>
            <span class='' style='color: red;'> " . $pymet_id . "</span>
        </div>

        <!-- Payment Date -->
        <div class='row' style='padding: 1%;'>
            <span class='col-md-3' style='font-weight: bold;'>Payment Date : </span>
            <span class='' style=''> " . $pdate . "</span>
        </div>

        <div class=''>For any queries, visit www.AirTravel.com or make a call to 000001324</div>
        <div class=''>Have a happy and safe journey ;)</div>


    </div>

</body>

</html>";

// Generate pdf and open pdf
$mpdf = new \Mpdf\Mpdf();
$mpdf->WriteHTML($html);
// $pdf = $mpdf->Output();
$pdf = $mpdf->Output("Ticket.pdf",'D');

?>