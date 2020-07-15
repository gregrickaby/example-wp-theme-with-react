# WP Theme with React

A WordPress theme with React and @wordpress/scripts. Proof of concept using `@wordpress/scripts` to import NPM packages and create simple React components throughout your theme.

For example, loading your Logo/Header area using React:

```js
import React from 'react';
import Img from 'react-cool-img';

export default function Logo() {
	return (
		<div className="header">
			<Img
				src="https://picsum.photos/200/75"
				alt="Logo"
				className="logo"
			/>
			<h1>Site Name</h1>
			<p>Site Description</p>
		</div>
	);
}
```

See [Logo.js](https://github.com/gregrickaby/wp-theme-with-react/blob/master/src/components/Logo.js)

## Install

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
