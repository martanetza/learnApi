<?php
http_response_code(404);
header('Content-Type: application/json');

$email = $_GET['email'];
$bookingNumber = $_GET['bookingNumber'];

$sData = file_get_contents('users.json');
$jUsers = json_decode($sData);

foreach ($jUsers as $user) {
    if ($user->email == $email && $user->bookings->number == $bookingNumber) {
        http_response_code(200);

        echo json_encode($user->bookings->flight);
    }
}
