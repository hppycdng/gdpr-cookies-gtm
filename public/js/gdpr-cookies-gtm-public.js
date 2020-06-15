/*! js-cookie v2.2.1 | MIT */

!function(a){var b;if("function"==typeof define&&define.amd&&(define(a),b=!0),"object"==typeof exports&&(module.exports=a(),b=!0),!b){var c=window.Cookies,d=window.Cookies=a();d.noConflict=function(){return window.Cookies=c,d}}}(function(){function a(){for(var a=0,b={};a<arguments.length;a++){var c=arguments[a];for(var d in c)b[d]=c[d]}return b}function b(a){return a.replace(/(%[0-9A-Z]{2})+/g,decodeURIComponent)}function c(d){function e(){}function f(b,c,f){if("undefined"!=typeof document){f=a({path:"/"},e.defaults,f),"number"==typeof f.expires&&(f.expires=new Date(1*new Date+864e5*f.expires)),f.expires=f.expires?f.expires.toUTCString():"";try{var g=JSON.stringify(c);/^[\{\[]/.test(g)&&(c=g)}catch(j){}c=d.write?d.write(c,b):encodeURIComponent(c+"").replace(/%(23|24|26|2B|3A|3C|3E|3D|2F|3F|40|5B|5D|5E|60|7B|7D|7C)/g,decodeURIComponent),b=encodeURIComponent(b+"").replace(/%(23|24|26|2B|5E|60|7C)/g,decodeURIComponent).replace(/[\(\)]/g,escape);var h="";for(var i in f)f[i]&&(h+="; "+i,!0!==f[i]&&(h+="="+f[i].split(";")[0]));return document.cookie=b+"="+c+h}}function g(a,c){if("undefined"!=typeof document){for(var e={},f=document.cookie?document.cookie.split("; "):[],g=0;g<f.length;g++){var h=f[g].split("="),i=h.slice(1).join("=");c||'"'!==i.charAt(0)||(i=i.slice(1,-1));try{var j=b(h[0]);if(i=(d.read||d)(i,j)||b(i),c)try{i=JSON.parse(i)}catch(k){}if(e[j]=i,a===j)break}catch(k){}}return a?e[a]:e}}return e.set=f,e.get=function(a){return g(a,!1)},e.getJSON=function(a){return g(a,!0)},e.remove=function(b,c){f(b,"",a(c,{expires:-1}))},e.defaults={},e.withConverter=c,e}return c(function(){})});

if ( Cookies.get('user-gdpr-preferences') === undefined) {
	Cookies.set('user-gdpr-preferences', 'unset', {expires: 365, path: ''})
}

(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
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

})( jQuery );



