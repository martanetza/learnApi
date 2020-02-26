
<?php

$email = trim($_POST['email']);
$phonenumber = trim($_POST['phonenumber']);
$id =  $_POST['flightid'];

$sFlightsData = file_get_contents('flights.json');
$jFlightsData = json_decode($sFlightsData);

$sUsersData = file_get_contents('users.json');
$jUsersData = json_decode($sUsersData);


$boughtFlight;
$fromCity;
$toCity;
$bookingNumber = uniqid();

foreach ($jFlightsData as $flight) {
    if ($flight->id == $id) {
        $boughtFlight = $flight;
        $fromCity = $flight->schedule[0]->fromCity;
        $toCity = $flight->schedule[count($flight->schedule) - 1]->fromCity;
    }
}



$jUser = new stdClass();

$jUser->email = $email;
$jUser->phonenumber = $phonenumber;
$jUser->bookings->number = $bookingNumber;
$jUser->bookings->flight = $boughtFlight;

array_push($jUsersData, $jUser);

$sUsersData = json_encode($jUsersData, JSON_PRETTY_PRINT);



file_put_contents('users.json', $sUsersData);

include 'send-email.php';
include 'send-sms.php';
