# Example WP Theme with React

Have you ever wanted to use a traditional WordPress theme, but add dynamic user interfaces to the front-end? Maybe there's an NPM package that you want to use, but you're not sure how to import and bundle it?

This repo is a proof of concept using [@wordpress/scripts](https://developer.wordpress.org/block-editor/packages/packages-scripts/) to bundle theme assets, and load the current weather conditions from the DarkSky API in the theme header.

## Demo

First, we need to enqueue the styles and scripts (and their depdenencies e.g., React and ReactDom) in `functions.php`:

```php
/* functions.php */

function example_scripts() {
	// Include the asset file generated by Webpack. This file includes dependencies!
	// https://developer.wordpress.org/block-editor/tutorials/javascript/js-build-setup/#dependency-management
	$asset_file = include 'build/index.asset.php';

	// Enqueue theme style.
	wp_enqueue_style( 'example-theme-style', get_stylesheet_directory_uri() . '/build/index.css', [], $asset_file['version'] );

	// Enqueue theme scripts.
	wp_enqueue_script( 'example-theme-script', get_stylesheet_directory_uri() . '/build/index.js', $asset_file['dependencies'], $asset_file['version'], true );
	wp_script_add_data( 'example-theme-script', 'async', true );
}
add_action( 'wp_enqueue_scripts', 'example_scripts' );
```

Now let's fetch current weather conditions in Los Angeles, CA from the DarkSky API:

```js
/* src/components/Header.js */

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

  // Return our weather component.
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
```

Style the `<Weather />` component using Sass in `index.scss`:

```scss
/* src/index.scss */

.current-weather {
  text-align: right;

  p {
    margin: 0;
    padding: 0;
  }

  .current-location {
    font-size: 18px;
    font-weight: 700;
  }
}
```

Import both the Sass file `index.scss` and `<Weather />` component into the entry file `index.js`. _The entry file is what `@wordpress/scripts` needs in order to bundle assets. We also need attach the `<Weather />` component to `#weather` using `ReactDom.render()`:_

```js
/* src/index.js */

import "./index.scss";
import Weather from "./components/Weather";

// Attach <Weather /> component to <div id="weather">.
ReactDOM.render(<Weather />, document.getElementById("weather"));
```

Now tell `@wordpress/scripts` to bundle everything up!

```bash
npm run build
```

The weather loaded in the header area: 👇 💥
![screenshot](https://dl.dropbox.com/s/xvb1q50lr2b42ah/Screenshot%202020-07-21%2011.52.33.png?dl=0)

### What just happened?

In `functions.php` [we're enqueueing](https://github.com/gregrickaby/wp-theme-with-react/blob/master/functions.php) our bundled JavaScript and CSS file and requiring `wp-element` as a depdendency, which includes both React and ReactDom. These files will be loaded on the front-end!

## Try out this demo

Clone down the repo into `wp-content/themes` and install the dependencies:

```bash
git@github.com:gregrickaby/example-wp-theme-with-react.git
```

```bash
cd themes/example-wp-theme-with-react
```

```bash
npm install
```

Activate the theme in WordPress.

## Development

To start HMR:

```bash
npm run start
```

To lint scripts and styles:

```bash
npm run lint
```

To build production ready assets:

```bash
npm run build
```
