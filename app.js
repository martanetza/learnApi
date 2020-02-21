async function getFromCities() {
  var conection = await fetch("api-get-from-cities.php");
  var aCitiesNames = await conection.json();

  //   var aCitiesNames = ["a", "b", "c"];

  for (i = 0; i < aCitiesNames.length; i++) {
    renderFromCity(aCitiesNames[i]);
  }
  oFromCityResults = document.querySelector("#fromCityResults");
  oFromCityResults.style.display = "block";
  console.log("x");
}

function renderFromCity(cityName) {
  oFromCityResults = document.querySelector("#fromCityResults");
  var sDivCityName = `<div>${cityName}</div>`;
  oFromCityResults.innerHTML += sDivCityName;
}
