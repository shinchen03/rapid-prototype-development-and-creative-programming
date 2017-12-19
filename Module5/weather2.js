function fetchWeather()
    {
        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open("GET", " http://classes.engineering.wustl.edu/cse330/content/weather_json.php", true);
        xmlHttp.addEventListener("load", updateweather, false);
        xmlHttp.send(null);
    }
    
    function updateweather(event){

    var jsonData = JSON.parse(event.target.responseText); 
    document.getElementById("weatherWidget").getElementsByClassName("weather-loc")[0].innerHTML = jsonData.location.city + jsonData.location.state;
    document.getElementById("weatherWidget").getElementsByClassName("weather-humidity")[0].innerHTML = jsonData.atmosphere.humidity;
    document.getElementsByClassName("weather-temp")[0].innerHTML = jsonData.wind.chill;
    document.getElementsByClassName("weather-tomorrow")[0].src =  "http://us.yimg.com/i/us/nws/weather/gr/" + jsonData.tomorrow.code + "ds.png";
    document.getElementsByClassName("weather-dayaftertomorrow")[0].src =  "http://us.yimg.com/i/us/nws/weather/gr/" + jsonData.dayafter.code + "ds.png";
    
    }
    
document.addEventListener("DOMContentLoaded", fetchWeather, false);
document.getElementById("button").addEventListener("click", fetchWeather, false);