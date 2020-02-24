<?php
$flightID = $_GET['id'];
echo $flightID;
$sFlights = file_get_contents('flights.json');
$jFlights = json_decode($sFlights);
print_r($jFlights);

foreach ($jFlights as $flight) {
    if ($flight->id == $flightID) {
        $key = array_search($flight, $jFlights);

        array_splice($jFlights, $key, 1);
        break;
    }
}

$sData = json_encode($jFlights, JSON_PRETTY_PRINT);


file_put_contents('flights.json', $sData);

//redirect
// header('Location: cities.php');
