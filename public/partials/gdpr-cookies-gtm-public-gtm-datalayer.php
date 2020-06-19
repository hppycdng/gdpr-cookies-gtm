<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://happycoding.it
 * @since      1.0.0
 *
 * @package    Gdpr_Cookies_Gtm
 * @subpackage Gdpr_Cookies_Gtm/public/partials
 */
?>
<!-- Populate GTM dataLayer with Cookie preferences -->
<script>
    function populateDataLayer(callback)
    {
        if (Cookies.get('cookie-preference')) {

            var userCookiePreferences = JSON.parse(Cookies.get('cookie-preference'));
            console.log(userCookiePreferences);

            var dataLayer = [];
            userCookiePreferences.forEach(function (item) {
                var key = item.name;
                var data = {};
                data[key] = item.state;
                dataLayer.push(data);
            });
        }
        if (callback instanceof Function) { callback(); }
    }

    populateDataLayer(function(){});

    if (Cookies.get('cookie-preference')) {

        var userCookiePreferences = JSON.parse(Cookies.get('cookie-preference'));
        console.log(userCookiePreferences);

        var dataLayer = [];
        userCookiePreferences.forEach(function (item) {
            var key = item.name;
            var data = {};
            data[key] = item.state;
            dataLayer.push(data);
        });
    }

</script>
<!-- End Populate GTM dataLayer with Cookie preferences -->
