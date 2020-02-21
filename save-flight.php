<?php

//routes schedule
$aAirlinesNames = $_POST['airlinesName'];
$aAirlinesShortcuts = $_POST['airlinesShortcut'];
$aFromCities = $_POST['fromCity'];
$aToCities = $_POST['toCity'];
$aDepartureTimes = $_POST['departureTime'];
$aArrivalTimes = $_POST['arrivalTime'];
$aWaitingTimes = $_POST['waitingTime'];


print_r($aAirlinesNames);


//flight info

$price = $_POST['price'];


//create flight
$sFlights = file_get_contents('flights.json');
$jFlights = json_decode($sFlights);

$jFlight = new stdClass();

$jFlight->price = $price;
$jFlight->id = uniqid();
$jFlight->schedule = [];

array_push($jFlights, $jFlight);

//loop through all the routes
for ($i = 0; $i < count($aAirlinesNames); $i++) {
    $jRoute = new stdClass();
    $jRoute->airlinesName = $aAirlinesNames[$i];
    $jRoute->airlinesShortcut  = $aAirlinesShortcuts[$i];
    $jRoute->fromCity = $aFromCities[$i];
    $jRoute->toCity = $aToCities[$i];
    $jRoute->departureTime = $aDepartureTimes[$i];
    $jRoute->departureTime = $aDepartureTimes[$i];
    $jRoute->arrivalTime = $aArrivalTimes[$i];
    $jRoute->waitingTime = $aWaitingTimes[$i];

    array_push($jFlight->schedule, $jRoute);
}




//write that back to the file
$sFlights = json_encode($jFlights, JSON_PRETTY_PRINT);



file_put_contents('flights.json', $sFlights);


// header('Location: admin.php');
