/**
 * Responsive Navbar.
 *
 */
document.getElementById( 'navigation--togller' ).addEventListener( 'click', myFunction );

function myFunction() {
	var x = document.getElementById( 'site-navigation' );
	if ( 'designfly-main-navigation' === x.className ) {
		x.className += ' responsive';
	} else {
		x.className = 'designfly-main-navigation';
	}
}
