<?php

$email = $_GET['email'];
$bookingNumber = $_GET['bookingNumber'];

$sData = file_get_contents('users.json');
$jUsers = json_decode($sData);

foreach ($jUsers as $user) {
    if ($user->email == $email && $user->bookings->number == $bookingNumber) {
        echo json_encode($user->bookings->flight);
    }
}
