/**
 * File navigation.js.
 *
 * Handles toggling the navigation menu for small screens and enables TAB key
 * navigation support for dropdown menus.
 */
( function( $ ) {
	var container, button, menu, links, subMenus, i, len;
	container = document.getElementById( 'site-navigation' );
	if ( ! container ) {
		return;
	}

	//Button element (Hamburger)
	button = document.getElementById( 'nav-toggle' );
	if ( 'undefined' === typeof button ) {
		return;
	}

	menu = container.getElementsByTagName( 'ul' )[0];

	// Hide menu toggle button if menu is empty and return early.
	if ( 'undefined' === typeof menu ) {
		button.style.display = 'none';
		return;
	}

	menu.setAttribute( 'aria-expanded', 'false' );
	if ( -1 === menu.className.indexOf( 'nav-menu' ) ) {
		menu.className += ' nav-menu';
	}

	button.onclick = function() {
		if ( -1 !== container.className.indexOf( 'toggled' ) ) {
			container.className = container.className.replace( ' toggled', '' );
			button.setAttribute( 'aria-expanded', 'false' );
			menu.setAttribute( 'aria-expanded', 'false' );
		} else {
			container.className += ' toggled';
			button.setAttribute( 'aria-expanded', 'true' );
			menu.setAttribute( 'aria-expanded', 'true' );
		}
	};


	//Hamburger icon animation toggle
	document.querySelector( "#nav-toggle" )
	  .addEventListener( "click", function() {
	    this.classList.toggle( "active" );

	    if ( !$( '.mobile-grey-filter' ).hasClass( 'grey-out') ) {
	    	$( '.mobile-grey-filter' ).addClass( 'grey-out' );
	    } else {
	    	$( '.mobile-grey-filter' ).removeClass( 'grey-out' );

	    }
	   
	});

	  $( '.mobile-grey-filter' ).on( 'click', function() {

	  	$( '.mobile-grey-filter' ).removeClass( 'grey-out' );
  		$( '#nav-toggle' ).removeClass( 'active' );
		container.className = container.className.replace( ' toggled', '' );
		button.setAttribute( 'aria-expanded', 'false' );
		menu.setAttribute( 'aria-expanded', 'false' );

	  });

	// Get all the link elements within the menu.
	links    = menu.getElementsByTagName( 'a' );
	subMenus = menu.getElementsByTagName( 'ul' );

	// Set menu items with submenus to aria-haspopup="true".
	for ( i = 0, len = subMenus.length; i < len; i++ ) {
		subMenus[i].parentNode.setAttribute( 'aria-haspopup', 'true' );
	}

	// Each time a menu link is focused or blurred, toggle focus.
	for ( i = 0, len = links.length; i < len; i++ ) {
		links[i].addEventListener( 'focus', toggleFocus, true );
		links[i].addEventListener( 'blur', toggleFocus, true );
	}

	if (window.matchMedia('(min-width: 45em)').matches) {

		$('ul.nav-menu > li.menu-item-has-children').hover(
		  function() {
		  	var _this = $( this ).children( '.dropdown-toggle' );
		  	_this.toggleClass('hovering');
			_this.toggleClass( 'toggle-on' );
			_this.next( '.sub-menu' ).toggleClass( 'toggled-on' );
			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			_this.html( _this.html() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand );

		  }, function() {
		   	var _this = $( this ).children( '.dropdown-toggle' );
		   	_this.toggleClass('hovering');
			_this.toggleClass( 'toggle-on' );
			_this.next( '.sub-menu' ).toggleClass( 'toggled-on' );
			_this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );
			_this.html( _this.html() === screenReaderText.expand ? screenReaderText.collapse : screenReaderText.expand );
		  }
		);
	}


	/**
	 * Sets or removes .focus class on an element.
	 */
	function toggleFocus() {
		var self = this;

		// Move up through the ancestors of the current link until we hit .nav-menu.
		while ( -1 === self.className.indexOf( 'nav-menu' ) ) {

			// On li elements toggle the class .focus.
			if ( 'li' === self.tagName.toLowerCase() ) {
				if ( -1 !== self.className.indexOf( 'focus' ) ) {
					self.className = self.className.replace( ' focus', '' );
				} else {
					self.className += ' focus';
				}
			}

			self = self.parentElement;
		}
	}
} )( jQuery );
