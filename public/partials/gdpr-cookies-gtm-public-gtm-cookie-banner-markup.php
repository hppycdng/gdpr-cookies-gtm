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
<div id="gdpr-cookies-gtm-cookie-banner">
    <h4><?php echo $this->settings['banner-headline'] ?></h4>
    <?php echo $this->settings['banner-copy-text'] ?>
    <form>
        <?php
           $purposes = (count($this->settings['purposes'] ) > 0 ) ? $this->settings['purposes'] : array ();
           foreach ($purposes as $purpose) { ?>
               <label for="<?php echo $purpose['id'] ?>">
                   <input
                           type="checkbox"
                           id="<?php echo $purpose['id'] ?>"
                           name="<?php echo $purpose['id'] ?>"
                            <?php if ($purpose['id'] === "technically-necessary"): ?>
                              disabled checked
                            <?php endif; ?>
                   >
                <?php echo $purpose['name'] ?>
               </label>
          <?php }
        ?>
        <button class="button button-secondary" id="accept-selection"><?php _e('Cookie Auswahl bestätigen'); ?></button>
        <button class="button button-primary" id="accept-all"><?php _e('Alle Cookies akzeptieren'); ?></button>
    </form>
</div>
<!-- End Display the cookie banner -->
