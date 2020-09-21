(function ($) {
	"use strict";

	$(function () {
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
			inputElements.each(function () {
				var name = $(this).attr("name");
				var state = $(this).is(":checked");
				userCookiePreference.push({
					name,
					state,
				});
			});
			removeExistingPreferenceCookie(userCookiePreference, function () {
				setPreferenceCookies(userCookiePreference, function () {
					populateDataLayer(function () {
						callTagmanagerScript(function () {
							setTimeout(function () {
								hideCookieBanner();
							}, 150);
						});
					});
				});
			});
		}

		if (!Cookies.get("cookie-preference")) showCookieBanner();

		$(
			".gdpr-cookie-consent-show-banner-js, li.c-footer-nav-menu__item--gdpr-cookie-consent-show-banner-js > a"
		).click(function (e) {
			e.preventDefault();
			showCookieBanner();
		});

		$("#gdpr-cookies-gtm-cookie-banner #accept-selection").click(function (e) {
			e.preventDefault();
			evaluateFormAndSetSriptsAndCookies();
		});

		$("#gdpr-cookies-gtm-cookie-banner #accept-all").click(function (e) {
			e.preventDefault();
			var inputElements = cookieBannerElem.find('input[type="checkbox"]');
			inputElements.each(function () {
				var elem = $(this);
				elem.prop("checked", true);
				setTimeout(function () {
					evaluateFormAndSetSriptsAndCookies();
				}, 500);
			});
		});
	});
})(jQuery);
