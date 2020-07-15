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
