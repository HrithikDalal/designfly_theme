/**
 * Responsive Navbar.
 *
 */
jQuery( document ).ready( ( function( $ ) {
	$( '#masthead .navigation--togller' ).on( 'click', function() {
		$x = $( '#site-navigation' );
		$y = $x.attr( 'class' ) ;
		if ( 'designfly-main-navigation' === $y ) {
			$x.addClass( 'responsive' );
		} else {
			$x.removeClass( 'responsive' );
		}
	} );
}
)
);
