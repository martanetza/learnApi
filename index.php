<?php
// $iCheapestPrice = 999999999;
$sData = file_get_contents('most-popular-flights.json');
// echo $sData;
$jData = json_decode($sData);
$flightDiv = '';

$theShortest = $jData;

usort($theShortest, function ($first, $second) {
  return $first->totalTime > $second->totalTime;
});;

// $min = array_reduce($theShortest, function ($a, $b) {
//   return $a['price'] < $b['price'] ? $a : $b;
// }, array_shift($theShortest));

// print_r($min);

print_r($theShortest);
// $min = array_reduce($theShortest, function ($a, $b) {
//   return $a['value'] < $b['value'] ? $a : $b;
// }, array_shift($theShortest));

// print_r($min);

foreach ($jData as $jflight) {
  $iCheapestPrice = $iCheapestPrice ?? $jflight->price;
  $sDepartureDate =  $jflight->departureTime;
  $sDepartureDate = date("Y-m-d H:i", substr($sDepartureDate, 0, 10));
  if ($jflight->price < $iCheapestPrice) {
    $iCheapestPrice = $iCheapestPrice;
  }
  $flightDiv .=
    "
    <div id='flights'>

    <div id='flight'>
  <div id='flight-route'>
    <div class='row'>
      <input type='checkbox' />
      <div>
        <img src='icons/KL.png' alt='' />
      </div>
      <div>
      $sDepartureDate - 19.00
        <p>KLN</p>
      </div>
      <div>
        1 stop
        <p>Amsterdam</p>
      </div>
      <div>
        10h
        <p>CPH - MAI</p>
      </div>
    </div>
    <div class='row'>
      <input type='checkbox' />
      <div>
        <img src='icons/$jflight->companyShortcut.png' alt='' />
      </div>
      <div>
      $iCheapestPrice - 19.00
        <p>KLN</p>
      </div>
      <div>
        1 stop
        <p>Amsterdam</p>
      </div>
      <div>
        10h
        <p>CPH - MAI</p>
      </div>
    </div>
  </div>
  <div id='flight-price'>
  <div>  $jflight->price   kr</div>
  <button>buy</button>
</div>
</div>";
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
  <nav>
    <a id="logo" class="active" href="index.php">momondo</a>
    <a href="">fly</a>
    <a href="">hotel</a>
    <a href="">car</a>
    <a href="">trips</a>
    <a href="">discovery</a>
    <a href="">my trip</a>
    <a href="">login</a>
  </nav>

  <section id="search">
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
            <span class="price"> </span> <?= $iCheapestPrice; ?><span class="time">20t. 07min</span>
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
      <!-- <div id="stops-box">
          <div></div>
          <div></div>
        </div>
        <div id="stops"></div> -->
      <?php
      echo $flightDiv;

      ?>




      <!-- <div id="flight">

          <div id="flight-route">
            <div class="row">
              <input type="checkbox" />
              <div>
                <img src="icons/KL.png" alt="" />
              </div>
              <div>
                18.00 - 19.00
                <p>KLN</p>
              </div>
              <div>
                1 stop
                <p>Amsterdam</p>
              </div>
              <div>
                10h
                <p>CPH - MAI</p>
              </div>
            </div>
            <div class="row">
              <input type="checkbox" />
              <div>
                <img src="icons/KL.png" alt="" />
              </div>
              <div>
                18.00 - 19.00
                <p>KLN</p>
              </div>
              <div>
                1 stop
                <p>Amsterdam</p>
              </div>
              <div>
                10h
                <p>CPH - MAI</p>
              </div>
            </div>
          </div>

          <div id="flight-price">
            <div>3.400 kr</div>
            <button>buy</button>
          </div>
        </div> -->
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

<!-- <script>
  // Selv invoking function
  async function getFlights() {
    var connection = await fetch("momondo.php");
    var jData = await connection.json();
    console.log(jData);

    for (var i = 0; i < jData.length; i++) {
      // console.log(jData[i].schedule);
      var aOrderedSchedule = [];
      for (var n = 0; n < jData[i].schedule.length; n++) {
        aOrderedSchedule[jData[i].schedule[n].order] = jData[i].schedule[n];
      }
      // console.log(aOrderedSchedule);
      var sDivsWithStops = "";
      for (var n = 0; n < aOrderedSchedule.length; n++) {
        var sFromDate = new Date(0);
        sFromDate.setUTCSeconds(aOrderedSchedule[n].date);
        sFromDate = sFromDate.toLocaleString("da-DK");
        sDivsWithStops += `
        <div class="onceFlight">
          <img class="airline-icon" src="icons/${aOrderedSchedule[n].airlineIcon}">
          <div>FROM: ${aOrderedSchedule[n].from}</div>
          <div>DATE: ${sFromDate}</div>
        </div>`;
      }

      var jLastCity = aOrderedSchedule[aOrderedSchedule.length - 1];
      // console.log(jLastCity);
      var sTo = `<div>Arrives at city: ${jLastCity.to}</div>`;

      document.getElementById("results").innerHTML += `
                          <div id="stops-box"> 
                        <div class="oneDivsWithStops"> 
                        ${sDivsWithStops} ${sTo}
                        </div> 
                        <div class="price"></div>
                         </div>`;
    }
  }
  getFlights();
</script> -->