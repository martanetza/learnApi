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
