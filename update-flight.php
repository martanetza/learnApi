<?php

if (isset($_POST['id']) && isset($_POST['modal-price'])) {
    echo 'user trying to save data';

    $sFlights = file_get_contents('flights.json');
    $jFlights = json_decode($sFlights);

    foreach ($jFlights as $jFlight) {
        if ($jFlight->id == $_POST['id']) {
            $jFlight->price = $_POST['modal-price'];

            break;
        }
    }

    $sData = json_encode($jFlights, JSON_PRETTY_PRINT);


    file_put_contents('flights.json', $sData);
}
