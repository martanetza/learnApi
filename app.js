async function getFromCities() {
  if (event.target.value.length == 0) {
    results.style.display = "none";
    return; // Return means take me out of the function
  }
  var sSearchTerm = event.target.value;
  url = "api-get-from-cities.php?cityName=" + sSearchTerm;
  var conection = await fetch(url);
  var jCities = await conection.json();
  console.log(conection);

  for (i = 0; i < jCities.cities.length; i++) {
    renderFromCity(jCities.cities[i]);
  }
  oFromCityResults = document.querySelector("#fromCityResults");
  oFromCityResults.style.display = "block";
  console.log("x");
}

function renderFromCity(cityName) {
  oFromCityResults = document.querySelector("#fromCityResults");
  var sDivCityName = `<div onclick="selectName()">${cityName}</div>`;
  oFromCityResults.innerHTML = sDivCityName;
}

function selectName() {
  document.querySelector("#fromCityInput").value = event.target.innerText;
  document.querySelector("#fromCityResults").style.display = "none";
}

function openBuyModal(flightid) {
  console.log(flightid);
  document.querySelectorAll(".modal").forEach(e => {
    if (e.dataset.flightid == flightid) {
      e.style.display = "block";
      console.log(flightid, e.dataset.flightid);
    }
  });
}

function closeBuyModal() {
  document.querySelectorAll(".modal").forEach(e => {
    e.style.display = "none";
  });
}

function moveForward(flightid) {
  document.querySelectorAll(".modal").forEach(e => {
    if (e.dataset.flightid == flightid) {
      e.querySelector(".userContactInfo").style.display = "none";
      e.querySelector(".confirmationInfo").style.display = "block";
      e.querySelector(".btn-next").style.display = "none";
      e.querySelector(".btn-cancel").classList.add("btn-next");
      e.querySelector(".btn-cancel").innerText = "finish";
    }
  });

  async function buyTicket() {
    var oForm = document.querySelector(`#buyTicketForm${flightid}`);
    console.log(oForm);
    var response = await fetch("save-ticket.php", {
      method: "POST",
      body: new FormData(oForm)
    });
  }
  buyTicket();
}

function openBookingModal() {
  document.querySelector(".modal-my-trip").style.display = "block";
}

function getBookingInfo() {
  async function getInfo() {
    var bookingNumber = document.querySelector("#bookingNumber").value;
    var email = document.querySelector("#bookingEmail").value;
    url =
      "get-ticket-details.php?email=" +
      email +
      "&bookingNumber=" +
      bookingNumber;
    console.log(url);
    var conection = await fetch(url);
    var jFlight = await conection.json();
    console.log(jFlight);
    document.querySelector(".modal-content-user-form").style.display = "none";
    document.querySelector(".modal-content-flight-info").innerHTML = `
    <div><span>Price:</span> ${jFlight.price}</div>
    <div><span>Total time:</span> ${jFlight.totalTime}</div>

    <div><span>Flight from: </span>${jFlight.schedule[0].fromCity}</div>
    <div><span>Flight to: </span> ${
      jFlight.schedule[jFlight.schedule.length - 1].toCity
    }</div>
    `;

    for (i = 0; i < jFlight.schedule.length; i++) {
      var departureTime = new Date(0);
      departureTime.setUTCSeconds(jFlight.schedule[i].departureTime);
      var arrivalTime = new Date(0);
      departureTime.setUTCSeconds(jFlight.schedule[i].arrivalTime);

      document.querySelector(".modal-content-flight-info").innerHTML += `
      <div><span>Deatils flight:  ${i + 1} </span></div> 
      <div><span>Airline:</span> ${jFlight.schedule[i].airlinesName}</div> 
      <div><span>From city:</span> ${jFlight.schedule[i].fromCity}</div> 
      <div><span>To City:</span> ${jFlight.schedule[i].toCity}</div> 
      <div><span>Departura:</span> ${departureTime}</div> 
      <div><span>Arrival:</span> ${arrivalTime}</div> 
       `;
    }
  }
  getInfo();
}
