import React, { useState, useEffect } from "react";

// Use CORS anywhere to bypass CORS issues.
const CORS_PROXY = `https://cors-anywhere.herokuapp.com/`;

// Set weather API URL.
const WEATHER_API = `https://api.darksky.net/forecast/62627807ae3841ba587c80d49b90759b/37.8267,-122.4233`;

export default function Weather() {
  // Set initial state.
  const [loading, setLoading] = useState(true);
  const [weather, setWeather] = useState();

  // Fetch weather data.
  useEffect(() => {
    async function fetchData() {
      const response = await fetch(CORS_PROXY + WEATHER_API);
      const data = await response.json();
      setWeather(data);
      setLoading(false);
    }
    fetchData();
  }, []);

  return (
    <div className="current-weather">
      {loading ? (
        <p>Getting weather info...</p>
      ) : typeof weather == "undefined" ? (
        <p>Unable to fetch results. Try reloading the page.</p>
      ) : (
        <>
          <p className="current-location">Los Angeles, CA</p>
          <p className="current-summary">
            {weather.currently.summary} and{" "}
            {Math.round(weather.currently.temperature)}F
          </p>
          <p className="daily-summary">{weather.daily.summary}</p>
        </>
      )}
    </div>
  );
}

// Mount <Weather /> component to <div id="weather">.
ReactDOM.render(<Weather />, document.getElementById("weather"));
