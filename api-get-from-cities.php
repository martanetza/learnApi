<?php

http_response_code(200);
header('Content-Type: application/json');

$aFromCities = ['a', 'b', 'c'];

echo json_encode($aFromCities);
