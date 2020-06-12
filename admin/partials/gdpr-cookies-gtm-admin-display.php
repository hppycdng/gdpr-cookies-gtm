<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://happycoding.it
 * @since      1.0.0
 *
 * @package    Gdpr_Cookies_Gtm
 * @subpackage Gdpr_Cookies_Gtm/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<div class="wrapper">

    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

    <form method="post" action="<?php echo esc_html( admin_url( 'admin-post.php' ) ); ?>">

        <div id="gdpr-cookies-gtm-settings">
            <h2><?php _e('Einstellungen','gdpr-cookies-gtm') ?></h2>

            <div class="options">
                <p>
                    <label for="gdpr-cookies-gtm-is-active"><?php _e('Sollen Banner und GTM-Code ausgespielt werden?','gdpr-cookies-gtm') ?></label>
                    <br />
                    <input
                            type="checkbox"
                            name="gdpr-cookies-gtm-is-active"
                            value="is-active"
	                        <?php echo (array_key_exists('is-active',$dataFromOptionsTable) && $dataFromOptionsTable['is-active'] === 1) ? "checked" : "" ?>
                    />
                </p>
                <p>
                    <label for="gdpr-cookies-gtm-container-id"><?php _e('Wie lautet die GTM Container-ID?','gdpr-cookies-gtm') ?></label>
                    <br />
                    <input
                            type="text"
                            name="gdpr-cookies-gtm-container-id"
                            value="<?php echo (array_key_exists('container-id',$dataFromOptionsTable)) ? $dataFromOptionsTable['container-id'] : "" ?>"
                    />
                </p>
                <p>
                    <label for="gdpr-cookies-gtm-banner-headline"><?php _e('Cookie Banner Überschrift','gdpr-cookies-gtm') ?></label>
                    <br />
                    <input
                            type="text"
                            name="gdpr-cookies-gtm-banner-headline"
                            value="<?php echo (array_key_exists('banner-headline',$dataFromOptionsTable)) ? $dataFromOptionsTable['banner-headline'] : "" ?>"
                    />
                </p>
                <p>
                    <label><?php _e('Cookie Banner Fließtext','gdpr-cookies-gtm') ?></label>
                    <br />
                    <?php
	                    $editorContent   = (array_key_exists('banner-copy-text',$dataFromOptionsTable)) ? $dataFromOptionsTable['banner-copy-text'] : "";
	                    $editorId = 'gdpr-cookies-gtm-banner-copy-text';
	                    wp_editor( $editorContent, $editorId );
                    ?>
                </p>
            </div>
            <?php
                wp_nonce_field( 'gdpr-cookies-gtm-settings-save', 'gdpr-cookies-gtm-settings' );
                submit_button();
            ?>
        </div>
    </form>

</div><!-- .wrap -->