$( document ).ready( function () {

	/*
	 *
	 * General modal trigger opener
	 *
	 */
	$('.js_modal_trigger').on('click', function( event ){
		event.preventDefault();

		var modId = $(event.target).data('modId');
		$('.js_modal_box').fadeIn( 350 ); // Show Modal Box
		$('.body').addClass('modal-open'); // Freeze Page Layer
		$('.js_modal_box_content[data-mod-id="'+ modId +'"]').addClass('active'); // Activate Appropriate Modal Content

	});

	/*
	 *
	 * The Menu open and the General Modal Closer are the same button.
	 * On hitting the button when it says "Close", close any open modal or nav menu
	 * On hitting the button when it says "Menu", open the nav menu
	 *
	 */
	$( ".js_menu_opener.js_modal_closer" ).on( "click", function ( event ) {

		var $body = $( "body" )
		if ( $body.hasClass( "modal-open" ) ) {
			$body.removeClass( "modal-open nav-open" );
		}
		else {
			$body.addClass( "modal-open nav-open" );
		}

	} );

	/*
	 *
	 * On hitting the "ESCAPE" key, close any open modal or nav menu
	 *
	 */
	$( document ).on( "keyup", function ( event ) {

		var keyAlias = ( event.key || String.fromCharCode( event.which ) ).toLowerCase();
		var keyCode = parseInt( event.which || event.keyCode );

		if ( ! ( keyAlias == "esc" || keyAlias == "escape" || keyCode == 27 ) ) {
			return;
		}

		$( "body" ).removeClass( "modal-open nav-open" );

	} );

} );
