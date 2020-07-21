# Example WP Theme with React (Example)

Have you ever wanted to use a traditional WordPress theme, but add dynamic user interfaces to the front-end? Maybe there's an NPM package that you want to use, but you're not sure how to import and bundle it?

This repo is a proof of concept using [@wordpress/scripts](https://developer.wordpress.org/block-editor/packages/packages-scripts/) to import NPM packages and create simple React components throughout a traditional theme. Kind of like using jQuery!

## Demo

First, we need to enqueue React, ReactDom, and our CSS in `functions.php`:

```php
/* functions.php */

function example_scripts() {
	wp_enqueue_style( 'example-theme-style', get_stylesheet_directory_uri() . '/build/index.css', [], wp_get_theme()->get( 'Version' ) );
	wp_enqueue_script( 'example-theme-script', get_stylesheet_directory_uri() . '/build/index.js', [ 'wp-element' ], wp_get_theme()->get( 'Version' ), true );
	wp_script_add_data( 'example-theme-script', 'async', true );
}
add_action( 'wp_enqueue_scripts', 'example_scripts' );
```

Now we can build a header area using JSX and use the NPM package [React Cool Img](https://github.com/wellyshen/react-cool-img) to load in our logo. _Note: React Cool Img is not required, but I wanted to show you how can use ES6 imports to bring in other packages_

```js
/* src/components/Header.js */

import React from "react";
import Img from "react-cool-img";

export default function Header() {
  return (
    <div className="header">
      <Img src="https://picsum.photos/200/75" alt="Logo" className="logo" />

      <div className="branding">
        <h1>Site Name</h1>
        <p>Site Description</p>
      </div>
    </div>
  );
}
```

Style the `<Header />` component using Sass in `index.scss`:

```scss
/* src/index.scss */

.header {
  display: flex;

  .logo {
    margin-right: 24px;
  }

  .branding {
    display: flex;
    flex-direction: column;
  }
}
```

Import both the Sass file and `<Header />` component into the entry file `index.js`. The entry file is what @wordpress/scripts needs in order to bundle. We also need attach the `<Header />` component to `#site-header` div using `ReactDom.render()`:

```js
/* src/index.js */

import "./index.scss";
import Header from "./components/Header";

ReactDOM.render(
  <React.StrictMode>
    <Header />
  </React.StrictMode>,
  document.getElementById("site-header")
);
```

Now tell @wordpress/scripts to bundle everything up!

```bash
npm run build
```

The finished header 👇 💥

![screenshot](https://dl.dropbox.com/s/jseox2sxbk84fko/Screenshot%202020-07-15%2014.57.27.png?dl=0)

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
npm run dev
```

To lint scripts and styles:

```bash
npm run lint
```

To build production ready assets:

```bash
npm run build
```
