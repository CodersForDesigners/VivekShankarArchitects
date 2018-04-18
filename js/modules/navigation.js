
/*
 *
 * When scrolling through the page on mobile,
 * 1. Show the menu button on scrolling up.
 * 2. Hide the menu button on scrolling down.
 *
 */

var currentScrollPosition = window.scrollY || document.body.scrollTop;
var menuWidgetIsHidden = false;
var controlDisplayOfMenuButtonOnScroll = function () {

	var $menuWidget = $( ".js_menu_toggle" );

	return function controlDisplayOfMenuButtonOnScroll () {

		var scrollTop = window.scrollY || document.body.scrollTop;

		/*
		 * Show / hide the menu toggle depending on the scroll direction
		 */
		// Scrolling down
		if ( scrollTop > currentScrollPosition ) {
			// console.log( "The menu button should be hidden." )
			if ( ! menuWidgetIsHidden ) {
				menuWidgetIsHidden = true;
				$menuWidget.addClass( "hide" );
			}
		}

		// Scrolling up
		if ( scrollTop < currentScrollPosition ) {
			// console.log( "The menu button should be shown." )
			if ( menuWidgetIsHidden ) {
				menuWidgetIsHidden = false;
				$menuWidget.removeClass( "hide" );
			}
		}

		currentScrollPosition = scrollTop;

	};

}();

// onViewportScrollThrottle( controlDisplayOfMenuButtonOnScroll );
window.addEventListener( "scroll", controlDisplayOfMenuButtonOnScroll, true );



/*
 *
 * The expanding / collapsing sub-menus on the main navigation menu
 *
 */
$( ".js_sub_menu_trigger" ).on( "click", function ( event ) {

	event.preventDefault();

	var $subMenuTrigger = $( event.target );
	var $subMenu = $subMenuTrigger.nextAll( ".js_sub_menu" ).first();

	$subMenuTrigger.toggleClass( "active" );
	$subMenu.toggle();

} )


/*
 *
 * Smooth scroll to the section whenever a navigation menu item is hit
 *
 */
$( ".js_nav_section a" ).on( "click", function ( event ) {

	event.preventDefault();

	var domWhereTo = $( $( event.target ).attr( "href" ) ).get( 0 );
	domWhereTo.scrollIntoView( { behavior: "smooth" } );

	// Close the navigation menu
	$( "body" ).removeClass( "modal-open nav-open" );

} )
