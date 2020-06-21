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

<!-- Google Tag Manager -->
<script>
    function populateDataLayer(callback)
    {
        if (Cookies.get('cookie-preference')) {

            var userCookiePreferences = JSON.parse(Cookies.get('cookie-preference'));

            window.dataLayer = window.dataLayer || [];
            userCookiePreferences.forEach(function (item) {
                var key = item.name;
                var data = {};
                data[key] = item.state;
                window.dataLayer.push(data);
            });
        }
        if (callback instanceof Function) { callback(); }
    }

    populateDataLayer(function(){});

    if (Cookies.get('cookie-preference')) {

        var userCookiePreferences = JSON.parse(Cookies.get('cookie-preference'));
        console.log(userCookiePreferences);

        window.dataLayer = window.dataLayer || [];
        userCookiePreferences.forEach(function (item) {
            var key = item.name;
            var data = {};
            data[key] = item.state;
            window.dataLayer.push(data);
        });
    }

    function callTagmanagerScript(callback) {

        if (Cookies.get('cookie-preference')) {

            var userCookiePreferences = JSON.parse(Cookies.get('cookie-preference'));

            if (userCookiePreferences.filter((v) => (v.state === true)).length > 1) {

                (function (w, d, s, l, i) {
                    w[l] = w[l] || [];
                    w[l].push({
                        'gtm.start':
                            new Date().getTime(), event: 'gtm.js'
                    });
                    var f = d.getElementsByTagName(s)[0],
                        j = d.createElement(s), dl = l != 'dataLayer' ? '&l=' + l : '';
                    j.async = true;
                    j.src =
                        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                    f.parentNode.insertBefore(j, f);
                })(window, document, 'script', 'dataLayer', '<?php echo $this->gtm_container_id; ?>');
            }
        }
        if (callback instanceof Function) { callback(); }
    }

    callTagmanagerScript(function () {});
</script>
<!-- End Google Tag Manager -->
