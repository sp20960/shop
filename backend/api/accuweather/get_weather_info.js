const locationKey = 1466169;
const urlApi = "https://dataservice.accuweather.com/currentconditions/v1/"
const endpoint = '/student023/shop/backend/api/accuweather/save_weather_info.php'

async function sendWeatherInfo(info){
  try {

    const response = await fetch(endpoint, {
      method: 'POST',
      body: JSON.stringify({info: info}),
      headers: {
        "Content-Type": "application/json"
      }
    });

    jq
  } catch (error) {
    console.log(error)
  }
}

// function getLocationKey(){
//   const options = {method: 'GET', headers: {Authorization: 'Bearer ' + apiKey}};

//   fetch('https://dataservice.accuweather.com/locations/v1/cities/geoposition/search?q=39.8, 4.25', options)
//   .then(response => response.json())
//   .then(response => console.log(response.Key))
  
// }

async function getWeatherInfo(){
  try {
    const options = {method: 'GET', headers: {Authorization: 'Bearer ' + apiKey}};

    const response = await fetch(urlApi + locationKey, options);
    const jsonWeather = await response.json();

    sendWeatherInfo(jsonWeather);
  } catch (error) {
    console.log(error)
  }
}

getWeatherInfo();