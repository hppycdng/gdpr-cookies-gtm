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
<!-- Display the cookie banner -->
<?php
$lang = (defined('ICL_LANGUAGE_CODE')) ? ICL_LANGUAGE_CODE : "en";
?>
<div id="gdpr-cookies-gtm-cookie-banner-wrapper" class="gdpr-cookies-gtm-cookie-banner-wrapper-js">
  <div id="gdpr-cookies-gtm-cookie-banner">
    <h4><?php echo $this->settings['banner-headline-' . $lang] ?></h4>
    <div class="text"><?php echo $this->settings['banner-copy-text-' . $lang] ?></div>
    <form>
      <ul class="round">
        <?php
        $purposes = (count($this->settings['purposes']) > 0) ? $this->settings['purposes'] : array();
        foreach ($purposes as $key => $purpose) { ?>
          <li>
            <label for="<?php echo $purpose['id'] ?>">
              <input type="checkbox" id="<?php echo $purpose['id'] ?>" name="<?php echo $purpose['id'] ?>" <?php if ($key === 0) : ?> disabled checked <?php endif; ?>>
              <span class="checkmark"></span>
              <?php echo $purpose['name-' . $lang] ?>
            </label>
          </li>
        <?php } ?>
      </ul>
      <div class="button-wrapper">
        <button class="button button-secondary" id="accept-selection"><?php _e('Cookie Auswahl bestätigen'); ?></button>
        <button class="button button-primary" id="accept-all"><?php _e('Alle Cookies akzeptieren'); ?></button>
      </div>
    </form>
  </div>
</div>
<!-- End Display the cookie banner -->
