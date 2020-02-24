function addRoute() {
  var newRoute = document.createElement("div");
  document.querySelector(".routes-modal").appendChild(newRoute);

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

async function deleteFlight() {
  var id = event.target.dataset.todelete;
  var jResponse = await fetch(`delete-flight.php?id=${id}`);
  console.log(event.target.dataset.todelete);
}

function addFlight() {
  async function saveFlight() {
    var oForm = document.querySelector("#addFlightFmr");
    var jConnection = await fetch("save-flight.php", {
      method: "POST",
      body: new FormData(oForm)
    });
    // var sData = await jConnection.text();

    document.querySelectorAll(".modal input").forEach(e => {
      e.value = "";
    });
    getItems();
  }
  saveFlight();
  closeModal();
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
  document.querySelectorAll(".modal .newRoute").forEach(e => {
    e.innerHTML = "";
  });
  document.querySelectorAll(".modal input").forEach(e => {
    e.value = "";
  });
}

String.prototype.toHHMM = function() {
  var sec_num = parseInt(this, 10);
  var hours = Math.floor(sec_num / 3600);
  var minutes = Math.floor((sec_num - hours * 3600) / 60);

  if (minutes < 10) {
    minutes = "0" + minutes;
  }

  return hours + "h " + minutes + "m";
};

async function getItems() {
  document.getElementById("results").innerHTML = "";
  var jResponse = await fetch("get-flights.php");
  var jData = await jResponse.json();
  var sCopy = sBluePrint;
  var sCopyBluePrintFlight = sBluePrintFlight;
  for (var i = 0; i < jData.length; i++) {
    var sItemFlight = sCopyBluePrintFlight.replace(
      "::flight id::",
      "id" + jData[i].id
    );
    sItemFlight = sItemFlight.replace("::price::", jData[i].price);
    sItemFlight = sItemFlight.replace("::id to delete::", jData[i].id);
    document
      .getElementById("results")
      .insertAdjacentHTML("afterbegin", sItemFlight);

    for (var j = 0; j < jData[i].schedule.length; j++) {
      // covert data

      //waiting time:
      var waitingTimeSec = jData[i].schedule[j].waitingTime.toString();
      var waitingTimeHHMM = waitingTimeSec.toHHMM();
      //flying time
      var flyingTimeSec = jData[i].schedule[j].flyingTime.toString();
      var flyingTimeHHMM = flyingTimeSec.toHHMM();

      var departure = new Date(0);
      departure.setUTCSeconds(jData[i].schedule[j].departureTime);
      var departureTime =
        departure.getUTCHours() + ":" + departure.getUTCMinutes();
      if (departure.getUTCMinutes() < 10) {
        departureTime += "0";
      }
      var aMonths = [
        "Jan",
        "Feb",
        "Mar",
        "Apr",
        "May",
        "Jun",
        "Jul",
        "Aug",
        "Sep",
        "Okt",
        "Nov",
        "Dec"
      ];

      var departureDate =
        departure.getDate() + " " + aMonths[departure.getMonth()];
      var arrival = new Date(0);
      arrival.setUTCSeconds(jData[i].schedule[j].arrivalTime);
      var arrivalTime = arrival.getUTCHours() + ":" + arrival.getUTCMinutes();
      if (arrival.getUTCMinutes() < 10) {
        arrivalTime += "0";
      }
      //insert data
      var sItem = sCopy.replace("::date from::", departureDate);
      sItem = sItem.replace("::city from::", jData[i].schedule[j].fromCity);
      sItem = sItem.replace("::city to::", jData[i].schedule[j].toCity);
      sItem = sItem.replace("::time from::", departureTime);
      sItem = sItem.replace("::time to::", arrivalTime);
      sItem = sItem.replace("::time-flight::", flyingTimeHHMM);
      sItem = sItem.replace("::city waiting::", jData[i].schedule[j].toCity);
      if (jData[i].schedule[j].waitingTime <= 0) {
        console.log();
        sItem = sItem.replace("::show or hide::", "hide");
      } else {
        sItem = sItem.replace("::show or hide::", "show");
      }
      sItem = sItem.replace("::waiting time::", waitingTimeHHMM);
      document
        .querySelector(`#id${jData[i].id} .routes`)
        .insertAdjacentHTML("beforeend", sItem);
    }
  }
}
getItems();
