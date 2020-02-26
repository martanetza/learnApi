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

  //   var aCitiesNames = ["a", "b", "c"];

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
