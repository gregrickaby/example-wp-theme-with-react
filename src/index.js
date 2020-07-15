import './index.scss';
import Prism from 'prismjs';

import Logo from './components/Logo';

ReactDOM.render(
	<React.StrictMode>
		<Logo />
	</React.StrictMode>,
	document.getElementById( 'site-header' )
);
