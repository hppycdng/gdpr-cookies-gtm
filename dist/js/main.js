/*! GDPR Cookies GTM Plugin for Wordpress v1.0.0 | (c) 2020 Matthias Radscheit | MIT License */
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
	$((function() {
		var divElem = $('#gdpr-cookies-gtm-purpose-area');
		var i = $('#gdpr-cookies-gtm-purpose-area p').size() + 1;

		$('.gdpr-cookies-gtm-add-purpose-js').live('click', (function(e) {
			e.preventDefault();
			$('<p> <label for="gdpr-cookies-gtm-purposes"> <input type="text" name="gdpr-cookies-gtm-purposes[' + i + '][id]" placeholder="sample-handle"/>' +
				' <input type="text" name="gdpr-cookies-gtm-purposes[' + i + '][name]" placeholder="Sample Handle" /> </label> ' +
				'<span><i class="dashicons dashicons-dismiss"></i> <a href="#"' +
				' class="gdpr-cookies-gtm-remove-purpose-js"> Remove</a></span></p>').appendTo(divElem);
			i++;
			return false;
		}));

		$('.gdpr-cookies-gtm-remove-purpose-js').live('click', (function() {
			if( i > 2 ) {
				$(this).parents('p').remove();
				i--;
			}
			return false;
		}));
	}));


})( jQuery );

(function ($) {
	"use strict";

	$((function () {
		var cookieBannerWrapper = $(".gdpr-cookies-gtm-cookie-banner-wrapper-js");
		var cookieBannerElem = $("#gdpr-cookies-gtm-cookie-banner");

		function hideCookieBanner() {
			cookieBannerWrapper.hide("slow");
		}

		function showCookieBanner() {
			cookieBannerWrapper.show("slow");
		}

		function removeExistingPreferenceCookie(userCookiePreference, callback) {
			if (Cookies.get("cookie-preference")) {
				Cookies.remove("cookie-preference");
			}
			if (callback instanceof Function) {
				callback();
			}
		}

		function setPreferenceCookies(userCookiePreference = [], callback) {
			Cookies.set("cookie-preference", JSON.stringify(userCookiePreference));
			if (callback instanceof Function) {
				callback();
			}
		}

		function evaluateFormAndSetSriptsAndCookies() {
			var inputElements = cookieBannerElem.find('input[type="checkbox"]');
			var userCookiePreference = [];
			inputElements.each((function () {
				var name = $(this).attr("name");
				var state = $(this).is(":checked");
				userCookiePreference.push({
					name,
					state,
				});
			}));
			removeExistingPreferenceCookie(userCookiePreference, (function () {
				setPreferenceCookies(userCookiePreference, (function () {
					populateDataLayer((function () {
						callTagmanagerScript((function () {
							setTimeout((function () {
								hideCookieBanner();
							}), 150);
						}));
					}));
				}));
			}));
		}

		if (!Cookies.get("cookie-preference")) showCookieBanner();

		$(".gdpr-cookie-consent-show-banner-js").click((function (e) {
			e.preventDefault();
			showCookieBanner();
		}));

		$("#gdpr-cookies-gtm-cookie-banner #accept-selection").click((function (e) {
			e.preventDefault();
			evaluateFormAndSetSriptsAndCookies();
		}));

		$("#gdpr-cookies-gtm-cookie-banner #accept-all").click((function (e) {
			e.preventDefault();
			var inputElements = cookieBannerElem.find('input[type="checkbox"]');
			inputElements.each((function () {
				var elem = $(this);
				elem.prop("checked", true);
				setTimeout((function () {
					evaluateFormAndSetSriptsAndCookies();
				}), 500);
			}));
		}));
	}));
})(jQuery);
