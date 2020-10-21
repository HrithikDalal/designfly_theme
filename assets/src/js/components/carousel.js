/**
 * CarouselJS.
 *
 */

var slideIndex = 1;
document.getElementById( 'carousel__button--left' ).addEventListener( 'click', function() {
	slideIndex += 1;
	showDivs( slideIndex );
}
);

document.getElementById( 'carousel__button--right' ).addEventListener( 'click', function() {
	slideIndex -= 1;
	showDivs( slideIndex );
}
);

function showDivs( n ) {
	var i;
	var posts = document.getElementsByClassName( 'carousel__slides' );
	if ( n > posts.length ) {
		slideIndex = 1;
	};
	if ( 1 > n ) {
		slideIndex = posts.length;
	}
	for ( i = 0; i < posts.length; i++ ) {
		posts[i].style.display = 'none';
	}
	posts[slideIndex - 1].style.display = 'block';
};
showDivs( slideIndex );
