<?php

//routes schedule
$aAirlinesNames = $_POST['airlinesName'];
$aAirlinesShortcuts = $_POST['airlinesShortcut'];
$aFromCities = $_POST['fromCity'];
$aToCities = $_POST['toCity'];
$aDepartureTimes = $_POST['departureTime'];
$aArrivalTimes = $_POST['arrivalTime'];
$aWaitingTimes = $_POST['waitingTime'];
$iTotalRouteTime;

print_r($aAirlinesNames);


//flight info

$price = $_POST['price'];


//create flight
$sFlights = file_get_contents('flights.json');
$jFlights = json_decode($sFlights);

$jFlight = new stdClass();

$iFlightTotalTime = 0;
$jFlight->price = $price;
$jFlight->totalTime = $iFlightTotalTime;
$jFlight->id = uniqid();
$jFlight->schedule = [];
$jFlight->totalTime = $iFlightTotalTime;

array_push($jFlights, $jFlight);

$iFlightTotalTime = 0;

//loop through all the routes
for ($i = 0; $i < count($aAirlinesNames); $i++) {
    // calculate total route and waiting time in seconds 
    $iDepartureEpochTime = strtotime($aDepartureTimes[$i]);
    $iArrivalEpochTime = strtotime($aArrivalTimes[$i]);
    $waitingTimeArray = explode(':', $aWaitingTimes[$i]);
    $iWaitingTimeSeconds = (intval($waitingTimeArray[0]) * 60 * 60) + (intval($waitingTimeArray[1]) * 60);
    $iFlyingTime = $iArrivalEpochTime - $iDepartureEpochTime;
    $iTotalRouteTime = $iArrivalEpochTime - $iDepartureEpochTime + $iWaitingTimeSeconds;
    $iFlightTotalTime += $iTotalRouteTime;

    $jRoute = new stdClass();
    $jRoute->airlinesName = $aAirlinesNames[$i];
    $jRoute->airlinesShortcut  = $aAirlinesShortcuts[$i];
    $jRoute->fromCity = $aFromCities[$i];
    $jRoute->toCity = $aToCities[$i];
    $jRoute->departureTime = $iDepartureEpochTime  + 3600;
    $jRoute->arrivalTime = $iArrivalEpochTime + 3600;
    $jRoute->waitingTime = $iWaitingTimeSeconds;
    $jRoute->flyingTime =  $iFlyingTime;
    $jRoute->totalTime =  $iFlightTotalTime;

    // $waitingTimeToArray = explode(':',  $aWaitingTimes[$i]);
    // $iHour = intval($waitingTimeToArray);

    array_push($jFlight->schedule, $jRoute);
}

$jFlight->totalTime = $iFlightTotalTime;



//write that back to the file
$sFlights = json_encode($jFlights, JSON_PRETTY_PRINT);



file_put_contents('flights.json', $sFlights);


// header('Location: admin.php');
