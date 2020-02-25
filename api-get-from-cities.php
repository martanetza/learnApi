<?php


http_response_code(200);
header('Content-Type: application/json');

$sData = file_get_contents('flights.json');
$jFlights = json_decode($sData);

$sSearchFor = $_GET['cityName'];


$jResponse = new stdClass();
$jResponse->cities = ["city"];


foreach ($jFlights as $jFlight) {
    if (stripos($jFlight->schedule[0]->fromCity, $sSearchFor) !== false) {


        $jResponse->cities[] =  $jFlight->schedule[0]->fromCity;
    }
}
echo json_encode($jResponse);
