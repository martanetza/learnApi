function addRoute() {
  var newRoute = document.createElement("div");
  document.querySelector(".routes").appendChild(newRoute);

  newRoute.innerHTML = `
  <div class="nextRouteBreak">next route </div>
  <div class="oneRoute newRoute">

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
              Departure time
              <input id="departureTime" name="departureTime[]" type="datetime-local" />
            </label>
            <label class="arrivalTime" for="arrivalTime">
              Arrival time
              <input id="arrivalTime" name="arrivalTime[]" type="datetime-local" />
            </label>
            <label class="waitingTime" for="waitingTime">
              Waiting time
              <input id="waitingTime" name="waitingTime[]" type="time" />
            </label>
            </div>
            `;
}

function addFlight() {
  async function saveFlight() {
    var oForm = document.querySelector("#addFlightFmr");
    var jConnection = await fetch("save-flight.php", {
      method: "POST",
      body: new FormData(oForm)
    });
    var sData = await jConnection.text();
    document.querySelectorAll(".modal input").forEach(e => {
      e.value = "";
    });
  }
  saveFlight();
  document.querySelector(".modal").style.display = "none";
}

function openModal() {
  document.querySelector(".modal").style.display = "block";
}

function closeModal() {
  document
    .querySelectorAll(".modal, .modal .newRoute, .modal .nextRouteBreak")
    .forEach(e => {
      e.style.display = "none";
    });
  document.querySelectorAll(".modal input").forEach(e => {
    e.value = "";
  });
}
