(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */
	$(function() {
		var divElem = $('#gdpr-cookies-gtm-purpose-area');
		var i = $('#gdpr-cookies-gtm-purpose-area p').size() + 1;

		$('.gdpr-cookies-gtm-add-purpose-js').live('click', function(e) {
			e.preventDefault();
			$('<p> <label for="gdpr-cookies-gtm-purposes"> <input type="text" name="gdpr-cookies-gtm-purposes[' + i + '][id]" placeholder="sample-handle"/>' +
				' <input type="text" name="gdpr-cookies-gtm-purposes[' + i + '][name]" placeholder="Sample Handle" /> </label> ' +
				'<span><i class="dashicons dashicons-dismiss"></i> <a href="#"' +
				' class="gdpr-cookies-gtm-remove-purpose-js"> Remove</a></span></p>').appendTo(divElem);
			i++;
			return false;
		});

		$('.gdpr-cookies-gtm-remove-purpose-js').live('click', function() {
			if( i > 2 ) {
				$(this).parents('p').remove();
				i--;
			}
			return false;
		});
	});


})( jQuery );
