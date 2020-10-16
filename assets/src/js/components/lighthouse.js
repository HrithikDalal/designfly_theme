/**
 * Lighthouse JS.
 *
 */

( function( $ ) {

	// Show Lightbox
	$( '#portfolio-wrapper .view-image' ).on( 'click', function() {

		// Get the Image url of the clicked portfolio item.
		$imgSrc = $( this ).next().find( 'img' ).attr( 'src' );

		// Get the title of portfolio item.
		$titleDiv = $( this ).next().next().clone();

		// Select Lightbox div.
		$img = $( '.lightbox .lightbox__content img' );

		// Show Lightbox.
		$( '.lightbox' ).css( 'display', 'flex' );

		// Add title of the portfolio item to the lightbox.
		$( '.lightbox .lightbox__content' ).append( $titleDiv );

		// Provide image url to the lightbox.
		$img.attr( 'src', $imgSrc );
	}
	);

	// Close the Lightbox.
	$( '#lightbox .close' ).on( 'click', function() {

		// Remove The Title.
		$( this ).next().remove();

		// Hide the lightbox.
		$( this ).parent().parent().css( 'display', 'none' );
	}
	);
}
)( jQuery );
