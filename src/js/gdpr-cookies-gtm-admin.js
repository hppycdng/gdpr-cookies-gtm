(function ($) {
	"use strict";

	$(function () {
		var divElem = $("#gdpr-cookies-gtm-purpose-area");
		var i = $("#gdpr-cookies-gtm-purpose-area p").size() + 1;

		$(".gdpr-cookies-gtm-add-purpose-js").live("click", function (e) {
			e.preventDefault();
			$(
				'<p> <label for="gdpr-cookies-gtm-purposes"> <input type="text" name="gdpr-cookies-gtm-purposes[' +
					i +
					'][id]" placeholder="sample-handle"/>' +
					' <input type="text" name="gdpr-cookies-gtm-purposes[' +
					i +
					'][name-en]" placeholder="Sample Handle" />' +
					' <input type="text" name="gdpr-cookies-gtm-purposes[' +
					i +
					'][name-de]" placeholder="Sample Handle" /> </label> ' +
					'<span><i class="dashicons dashicons-dismiss"></i> <a href="#"' +
					' class="gdpr-cookies-gtm-remove-purpose-js"> Remove</a></span></p>'
			).appendTo(divElem);
			i++;
			return false;
		});

		$(".gdpr-cookies-gtm-remove-purpose-js").live("click", function () {
			if (i > 2) {
				$(this).parents("p").remove();
				i--;
			}
			return false;
		});
	});
})(jQuery);
