<?php
// $iCheapestPrice = 999999999;
$sData = file_get_contents('flights.json');
// echo $sData;
$jFlights = json_decode($sData);


// $theShortest = $jData;

// usort($theShortest, function ($first, $second) {
//   return $first->totalTime > $second->totalTime;
// });;

// $min = array_reduce($theShortest, function ($a, $b) {
//   return $a['price'] < $b['price'] ? $a : $b;
// }, array_shift($theShortest));

// print_r($min);

print_r($theShortest);
// $min = array_reduce($theShortest, function ($a, $b) {
//   return $a['value'] < $b['value'] ? $a : $b;
// }, array_shift($theShortest));

// print_r($min);

// foreach ($jData as $jflight) {
//   $iCheapestPrice = $iCheapestPrice ?? $jflight->price;
//   $sDepartureDate =  $jflight->departureTime;
//   $sDepartureDate = date("Y-m-d H:i", substr($sDepartureDate, 0, 10));
//   if ($jflight->price < $iCheapestPrice) {
//     $iCheapestPrice = $iCheapestPrice;
//   }
// }

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
    <form id="search" action="">
      <div id="fromCityBox">
        <input oninput="getFromCities()" type="text" placeholder="from city" />
        <div id="fromCityResults">
          <div>ABC

          </div>
        </div>
      </div>

      <button>&lt;- -&gt;</button>
      <input type="text" placeholder="to city" />
      <input type="text" placeholder="from date" />
      <input type="text" placeholder="to date" />
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
            <span class="price"> </span> <?= 'fix cheapest'; ?><span class="time">20t. 07min</span>
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
                  $fromTime = gmdate("H", $route->departureTime) . 'h ' . gmdate("i", $route->waitingTime) . 'min';
                  $toTime = gmdate("H", $route->arrivalTime) . 'h ' . gmdate("i", $route->waitingTime) . 'min';
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
            <button>buy</button>
          </div>
        </div>

      <?php

      endforeach
      ?>
    </div>
    </div>
  </main>
  <div class="modal">
    <div class="modal-content">
      <div id="confirmationInfo">
        <h3> Congratulation, you have bought a ticke to Amsterdam</h3>
        <p>You will now receive an email and a text message with your booking number</p>
      </div>
      <!-- <form id="userContactInfo" action="">
        <p>Please provide your email address and phone number to finish the order</p>
        <input type="text" placeholder="email">
        <input type="text" placeholder="phonenumber">
      </form> -->
      <div class="modal-nav">
        <button class="btn-cancel">
          Cancle
        </button>
        <button class="btn-next">
          Finish
        </button>
      </div>
    </div>
  </div>
  <script src="app.js"></script>
</body>

</html>