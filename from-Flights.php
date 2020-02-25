<?php

$sData = file_get_contents('flights.json');
$jFlights = json_decode($sData);
$filteredFlights = [];



if (isset($_POST['fromCity']) && isset($_POST['toCity'])) {

    $fromCity = trim($_POST['fromCity']);
    $toCity = trim($_POST['toCity']);
    $fromDate = trim($_POST['fromDate']);

    foreach ($jFlights as $jFlight) {
        $lastElement = count($jFlight->schedule) - 1;

        if (
            $fromCity == $jFlight->schedule[0]->fromCity
            && $toCity == $jFlight->schedule[$lastElement]->toCity
            && $fromDate ==  gmdate("Y-m-d", $jFlight->schedule[0]->departureTime)
        ) {
            array_push($filteredFlights, $jFlight);
            $jFlights = $filteredFlights;
        }
    }
}
