<?php
// $iCheapestPrice = 999999999;
require_once('from-Flights.php');
// $jFlights = json_decode($sData);



foreach ($jFlights as $jflight) {
  $iCheapestPrice = $iCheapestPrice ?? $jflight->price;

  if ($jflight->price < $iCheapestPrice) {
    $iCheapestPrice = $jflight->price;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="app.css" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet" />
  <title>momondo</title>
</head>

<body>
  <nav class="nav-admin">
    <a id="logo" class="active" href="index.php">momondo</a>
    <a href="">fly</a>
    <a href="">hotel</a>
    <a href="">car</a>
    <a href="">trips</a>
    <a href="">discovery</a>
    <a href="">my trip</a>
    <a href="">login</a>
  </nav>

  <section>
    <form id="search" action="index.php" method="POST" autocomplete="off">
      <div id="fromCityBox">
        <input oninput="getFromCities()" id="fromCityInput" name="fromCity" type="text" placeholder="from city" />
        <div id="fromCityResults">
          <div>ABC

          </div>
        </div>
      </div>

      <button>&lt;- -&gt;</button>
      <input name="toCity" type="text" placeholder="to city" />
      <input name="fromDate" type="date" placeholder="from date" value="2020-03-01" />
      <button>search</button>
    </form>

  </section>

  <section id="temporal">
    <img src="Capture.PNG" alt="" />
  </section>

  <main>
    <div id="options">
      Options
    </div>
    <div id="results">
      <div id="priceOptions">
        <div id="cheapest">
          CHEAPEST
          <p>
            <span class="price"> </span> <?= $iCheapestPrice . 'DKK'; ?><span class="time"> 20t. 07min</span>
          </p>
        </div>
        <div id="best" class="active">
          BEST
          <p>
            <span class="price">6.231 kr </span><span class="time">20t. 07min</span>
          </p>
        </div>
        <div id="fastest">
          FASTEST
          <p>
            <span class="price">6.231 kr </span><span class="time">20t. 07min</span>
          </p>
        </div>
        <div>
          CUSTOM
          <p>comapre</p>
        </div>
      </div>
      <?php
      foreach ($jFlights as $flight) :
        $totalTime = gmdate("H", $flight->totalTime) . 'h ' . gmdate("i", $flight->totalTime) . 'min';;

      ?>
        <div id="flight">
          <div id="flight-route">
            <div class="oneFlight" id="<?= $flight->id; ?>">

              <div class="routes">

                <?php
                $jRoutes = $flight->schedule;
                foreach ($jRoutes as $route) :
                  $fromDate = gmdate("m/d", $route->departureTime);
                  $fromTime = gmdate("H:i", $route->departureTime);
                  $toTime = gmdate("H:i", $route->arrivalTime);
                  $waitingTime = gmdate("H", $route->waitingTime) . 'h ' . gmdate("i", $route->waitingTime) . 'min';
                  $flightTime = gmdate("H", $route->flyingTime) . 'h ' . gmdate("i", $route->waitingTime) . 'min';

                  $showOrHide = 'show';
                  if ($route->waitingTime <= 0) {
                    $showOrHide = 'hide';
                  }
                ?>
                  <div class="route">
                    <div class="col-date">
                      <?php echo $fromDate; ?>
                    </div>
                    <div class="col-details">
                      <div class="row-details">
                        <div class="col-left">
                          <div><?= $fromTime; ?> — <?= $toTime; ?></div>
                          <div><?= $route->fromCity; ?> - <?= $route->toCity; ?></div>
                        </div>
                        <div class="col-right">
                          <?= ($flightTime[0] != '0') ?   $flightTime  :   trim($flightTime, "0"); ?>
                        </div>
                      </div>
                      <div class="waiting-time-row <?= $showOrHide; ?>">
                        <div class="col-left">Waiting time in <?= $route->toCity; ?></div>
                        <div class="col-right">
                          <?= ($waitingTime[0] != '0') ?   $waitingTime :   trim($waitingTime, "0"); ?>
                        </div>
                      </div>
                    </div>
                  </div>

                <?php

                endforeach
                ?>

              </div>

            </div>

          </div>
          <div id="flight-price">
            <div class="total-time-info">total time: <br><?= ($totalTime[0] != '0') ?   $totalTime :   trim($totalTime, "0"); ?> </div>
            <div><?= $flight->price; ?> DKK</div>
            <button data-flightid="<?= $flight->id; ?>" class="buy-button" onclick="openBuyModal('id<?= $flight->id; ?>')">buy</button>
          </div>
        </div>
        <div data-flightid="id<?= $flight->id; ?>" class=" modal">
          <div class="modal-content">
            <div class="confirmationInfo">
              <h3> Congratulation, you have bought a ticket to <?= $flight->schedule[count($flight->schedule) - 1]->toCity; ?></h3>
              <p>You will now receive an email and a text message with your booking number</p>
            </div>
            <form class="userContactInfo" id="buyTicketFormid<?= $flight->id; ?>" onsubmit="return false">
              <p>Please provide your email address and phone number to finish the order</p>
              <input name="email" type="text" placeholder="email">
              <input name="phonenumber" type="text" placeholder="phonenumber">
              <input name="flightid" type="hidden" value="<?= $flight->id; ?>">
            </form>
            <div class="modal-nav">
              <button onclick="closeBuyModal()" class="btn-cancel">
                Cancle
              </button>
              <button onclick="moveForward('id<?= $flight->id; ?>')" class="btn-next">
                Send
              </button>
            </div>
          </div>
        </div>
      <?php

      endforeach
      ?>
    </div>
    </div>
  </main>

  <script src="app.js"></script>
</body>

</html>