<?php
require_once('has-access.php');
$sUserEmail = $_SESSION['sEmail'];
$sBluePrint = file_get_contents('bluePrint.html');
$sBluePrintFlight = file_get_contents('bluePrintFlight.html');
$sBluePrintFlightEdit = file_get_contents('bluePrintFlightEdit.html');

$page_title = "Admin panel";
require_once('compTop.php');
require_once('compNav.php');


?>

<main>
  <section>
    <header>
      <div>List of flights</div>
      <div class="btn-open-modal" onclick="openModal()">+ add flight</div>
    </header>
    <div id="results">
      <div class="oneFlight">
        <div class="control">
          <div>
            edite
          </div>
          <div>
            delete
          </div>
        </div>
        <div class="route">
          <div class="col-date">
            23. feb.
          </div>
          <div class="col-details">
            <div class="row-details">
              <div class="col-left">
                <div>16:15 — 19:36</div>
                <div>Cancún (CUN) - Minneapolis (MSP)</div>
              </div>
              <div class="col-right">
                4t. 21min.
              </div>
            </div>
            <div class="waiting-time-row">
              <div class="col-left">Waiting time in Minneapolis</div>
              <div class="col-right">
                1t. 21min.
              </div>
            </div>
          </div>
        </div>
        <div class="route">
          <div class="col-date">
            23. feb.
          </div>
          <div class="col-details">
            <div class="row-details">
              <div class="col-left">
                <div>15:15 — 16:35</div>
                <div>Amsterdam (AMS) - København (CPH)</div>
              </div>
              <div class="col-right">
                1h. 21min.
              </div>
            </div>
          </div>
        </div>
        <div class="row-price">
          <div>Pirce <span>20000</span> dkk</div>
        </div>
      </div>
      <div class="oneFlight">
        <div class="control">
          <div>
            edite
          </div>
          <div>
            delete
          </div>
        </div>
        <div class="route">
          <div class="col-date">
            23. feb.
          </div>
          <div class="col-details">
            <div class="row-details">
              <div class="col-left">
                <div>16:15 — 19:36</div>
                <div>Cancún (CUN) - Minneapolis (MSP)</div>
              </div>
              <div class="col-right">
                4h. 21min.
              </div>
            </div>
            <div class="waiting-time-row">
              <div class="col-left">Waiting time in Minneapolis</div>
              <div class="col-right">
                1h. 21min.
              </div>
            </div>
          </div>
        </div>
        <div class="route">
          <div class="col-date">
            23. feb.
          </div>
          <div class="col-details">
            <div class="row-details">
              <div class="col-left">
                <div>15:15 — 16:35</div>
                <div>Amsterdam (AMS) - København (CPH)</div>
              </div>
              <div class="col-right">
                4h. 21min.
              </div>
            </div>
          </div>
        </div>
        <div class="row-price">
          <div>Pirce <span>20000</span> dkk</div>
        </div>
      </div>
    </div>
  </section>
  <div class="modal">
    <div class="modal-content">
      <div id="closeBth" onclick="closeModal()">X</div>
      <h2>Add a new flight</h2>
      <p>Routes details</p>
      <form id="addFlightFmr" onsubmit="return false">
        <section class="routes-modal">
          <div class="oneRoute">
            <label class="airlinesName" for="airlinesName">
              Airlines name
              <input id="airlinesName" name="airlinesName[]" type="text" />
            </label>
            <label class="airlinesShortcut" for="airlinesShortcut">
              Airlines shortcut
              <input id="airlinesShortcut" name="airlinesShortcut[]" type="text" />
            </label>
            <label class="fromCity" for="fromCity">
              From city
              <input id="fromCity" name="fromCity[]" type="text" />
            </label>
            <label class="toCity" for="toCity">
              To city
              <input id="toCity" name="toCity[]" type="text" />
            </label>

            <label class="departureTime" for="departureTime">
              Departure date and time
              <input id="departureTime" name="departureTime[]" type="datetime-local" />
            </label>
            <label class="arrivalTime" for="arrivalTime">
              Arrival date and time
              <input id="arrivalTime" name="arrivalTime[]" type="datetime-local" />
            </label>
            <label class="waitingTime" for="waitingTime">
              Waiting time
              <input id="waitingTime" name="waitingTime[]" type="time" />
            </label>
          </div>
        </section>
        <div id="btnAddRoute" onclick="addRoute()">+ add route</div>
        <label class="priceBox" for="price">
          Total price
          <input id="price" name="price" type="text" />
        </label>
        <button onclick="addFlight()" id="saveFlightButton">save</button>
      </form>
    </div>
  </div>

</main>
<script>
  var sBluePrint = `<?= $sBluePrint ?>`
  var sBluePrintFlight = `<?= $sBluePrintFlight ?>`
  var sBluePrintFlightEdit = `<?= $sBluePrintFlightEdit ?>`
</script>
<?php
require_once('compBottom.php')

?>