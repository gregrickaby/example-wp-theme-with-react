# WP Theme with React

A proof of concept using `@wordpress/scripts` to import NPM packages and create simple React components throughout a theme. Thanks to `@wordpress/scripts` v12, both Sass and importing the of NPM packages is now supported.

## Demo

Let's build a header area using React and the NPM package [React Cool Img](https://github.com/wellyshen/react-cool-img) (to lazy load our logo) for an example:

```js
/* src/components/Header.js */

import React from 'react';
import Img from 'react-cool-img';

export default function Header() {
	return (
		<div className="header">
			<Img
				src="https://picsum.photos/200/75"
				alt="Logo"
				className="logo"
			/>

			<div className="branding">
				<h1>Site Name</h1>
				<p>Site Description</p>
			</div>
		</div>
	);
}
```

Now create some styles in `index.scss`:

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

Then import the Sass file, and the `<Header />` component into the entry file `index.js`. We also need attach the `<Header />` to `#site-header` using `ReactDom.render()`:

```js
/* src/index.js */

import './index.scss';
import Header from './components/Header';

ReactDOM.render(
	<React.StrictMode>
		<Header />
	</React.StrictMode>,
	document.getElementById('site-header')
);
```

This will tell `@wordpress/scripts` to bundle everything up!

![screenshot](https://dl.dropbox.com/s/jseox2sxbk84fko/Screenshot%202020-07-15%2014.57.27.png?dl=0)

### How does this work?

In `functions.php` [we're enqueueing](https://github.com/gregrickaby/wp-theme-with-react/blob/master/functions.php#L23) `/build/index.js` and requireing `wp-element` as a depdendency, which includes both React and ReactDom.

## Try out this demo

Clone down the repo into `wp-content/themes` and install the dependencies:

```bash
git@github.com:gregrickaby/wp-theme-with-react.git
```

```bash
cd themes/wp-theme-with-react
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
