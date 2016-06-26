/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {


	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	wp.customize( 'phone-title-1', function( value ) {
		value.bind( function( to ) {
			$( '.phone-title-1' ).text( to );
		} );
	} );

	wp.customize( 'phone-title-2', function( value ) {
		value.bind( function( to ) {
			$( '.phone-title-2' ).text( to );
		} );
	} );

	wp.customize( 'phone-title-3', function( value ) {
		value.bind( function( to ) {
			$( '.phone-title-3' ).text( to );
		} );
	} );

	wp.customize( 'phone-1-1', function( value ) {
		value.bind( function( to ) {
			$( '.phone-1-1' ).text( to );
		} );
	} );

	wp.customize( 'phone-1-2', function( value ) {
		value.bind( function( to ) {
			$( '.phone-1-2' ).text( to );
		} );
	} );

	wp.customize( 'phone-1-3', function( value ) {
		value.bind( function( to ) {
			$( '.phone-1-3' ).text( to );
		} );
	} );

	wp.customize( 'phone-2-1', function( value ) {
		value.bind( function( to ) {
			$( '.phone-2-1' ).text( to );
		} );
	} );

	wp.customize( 'phone-2-2', function( value ) {
		value.bind( function( to ) {
			$( '.phone-2-2' ).text( to );
		} );
	} );

	wp.customize( 'phone-2-3', function( value ) {
		value.bind( function( to ) {
			$( '.phone-2-3' ).text( to );
		} );
	} );

	wp.customize( 'phone-3-1', function( value ) {
		value.bind( function( to ) {
			$( '.phone-3-1' ).text( to );
		} );
	} );

	wp.customize( 'phone-3-2', function( value ) {
		value.bind( function( to ) {
			$( '.phone-3-2' ).text( to );
		} );
	} );

	wp.customize( 'phone-3-3', function( value ) {
		value.bind( function( to ) {
			$( '.phone-3-3' ).text( to );
		} );
	} );




	wp.customize( 'mail-title-1', function( value ) {
		value.bind( function( to ) {
			$( '.mail-title-1' ).text( to );
		} );
	} );

	wp.customize( 'mail-title-2', function( value ) {
		value.bind( function( to ) {
			$( '.mail-title-2' ).text( to );
		} );
	} );

	wp.customize( 'mail-title-3', function( value ) {
		value.bind( function( to ) {
			$( '.mail-title-3' ).text( to );
		} );
	} );

	wp.customize( 'mail-1-1', function( value ) {
		value.bind( function( to ) {
			$( '.mail-1-1' ).text( to );
		} );
	} );

	wp.customize( 'mail-1-2', function( value ) {
		value.bind( function( to ) {
			$( '.mail-1-2' ).text( to );
		} );
	} );

	wp.customize( 'mail-1-3', function( value ) {
		value.bind( function( to ) {
			$( '.mail-1-3' ).text( to );
		} );
	} );

	wp.customize( 'mail-2-1', function( value ) {
		value.bind( function( to ) {
			$( '.mail-2-1' ).text( to );
		} );
	} );

	wp.customize( 'mail-2-2', function( value ) {
		value.bind( function( to ) {
			$( '.mail-2-2' ).text( to );
		} );
	} );

	wp.customize( 'mail-2-3', function( value ) {
		value.bind( function( to ) {
			$( '.mail-2-3' ).text( to );
		} );
	} );

	wp.customize( 'mail-3-1', function( value ) {
		value.bind( function( to ) {
			$( '.mail-3-1' ).text( to );
		} );
	} );

	wp.customize( 'mail-3-2', function( value ) {
		value.bind( function( to ) {
			$( '.mail-3-2' ).text( to );
		} );
	} );

	wp.customize( 'mail-3-3', function( value ) {
		value.bind( function( to ) {
			$( '.mail-3-3' ).text( to );
		} );
	} );



	wp.customize( 'footer-address', function( value ) {
		value.bind( function( to ) {
			var fix = to.replace(/,,/g, '<br/>');
			$( '.footer-address' ).html( fix );
		});
	});

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	var share_array = [ 'facebook', 'twitter', 'google-plus', 'reddit', 'email' ];
	share_array.forEach( function( social ) {

		wp.customize( social, function( value ) {
			value.bind( function( to ) {
				if ( to && $( '.' + social + '-link' ).parent().hasClass( 'hidden' ) ) {
					$( '.' + social + '-link' ).parent().removeClass( 'hidden' );
				} else if ( !to && !$( '.' + social + '-link' ).parent().hasClass( 'hidden' ) ) {
					$( '.' + social + '-link' ).parent().addClass( 'hidden' );
				}

			});
		});

	}, this );


} )( jQuery );
