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

  <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

  <form method="post" action="<?php echo esc_html(admin_url('admin-post.php')); ?>">

    <div id="gdpr-cookies-gtm-settings">
      <h2><?php _e('Settings', 'gdpr-cookies-gtm') ?></h2>

      <div class="options">
        <p>
          <label for="gdpr-cookies-gtm-is-active"><?php _e('Are Banner and GTM-script active?', 'gdpr-cookies-gtm') ?>
            <br />
            <input type="checkbox" name="gdpr-cookies-gtm-is-active" value="is-active" <?php echo (array_key_exists('is-active', $dataFromOptionsTable) && $dataFromOptionsTable['is-active'] === 1) ? "checked" : "" ?> />
          </label>
        </p>
        <p>
          <label for="gdpr-cookies-gtm-container-id"><?php _e('What\'s the GTM containers ID? (GTM-XXXXXX)', 'gdpr-cookies-gtm') ?>
            <br />

            <input type="text" name="gdpr-cookies-gtm-container-id" value="<?php echo (array_key_exists('container-id', $dataFromOptionsTable)) ? $dataFromOptionsTable['container-id'] : "" ?>" />
          </label>
        </p>
        <p>
          <label for="gdpr-cookies-gtm-banner-headline"><?php _e('Cookie Banner Headline', 'gdpr-cookies-gtm') ?>
            <br />
            <input type="text" name="gdpr-cookies-gtm-banner-headline" value="<?php echo (array_key_exists('banner-headline', $dataFromOptionsTable)) ? $dataFromOptionsTable['banner-headline'] : "" ?>" />
          </label>
        </p>
        <p>
          <label><?php _e('Cookie Banner Copy Text', 'gdpr-cookies-gtm') ?>
            <br />
            <?php
            $editorContent = (array_key_exists('banner-copy-text', $dataFromOptionsTable)) ? $dataFromOptionsTable['banner-copy-text'] : "";
            $editorId      = 'gdpr-cookies-gtm-banner-copy-text';
            wp_editor($editorContent, $editorId);
            ?>
          </label>
        </p>
        <div id="gdpr-cookies-gtm-purpose-wrapper">
          <div id="gdpr-cookies-gtm-purpose-area">
            <h3><?php _e('Cookie Purposes', 'gdpr-cookies-gtm') ?></h3>
            <?php if (array_key_exists('purposes', $dataFromOptionsTable) && count($dataFromOptionsTable['purposes']) > 0) : ?>
              <?php foreach ($dataFromOptionsTable['purposes'] as $key => $value) : ?>
                <p>
                  <label for="gdpr-cookies-gtm-purposes">
                    <input type="text" name="gdpr-cookies-gtm-purposes[<?php echo $key ?>][id]" value="<?php echo ($key === 0) ? "technically-necessary" : $value['id'] ?>" <?php if ($key === 0) : ?>disabled<?php endif; ?> />
                    <?php if ($key === 0) : ?>
                      <input type="hidden" name="gdpr-cookies-gtm-purposes[0][id]" value="technically-necessary">
                    <?php endif; ?>
                    <input type="text" name="gdpr-cookies-gtm-purposes[<?php echo $key ?>][name]" value="<?php echo $value['name'] ?>" placeholder="Sample Handle" />
                  </label>
                  <?php if ($key !== 0) : ?>
                    <span><i class="dashicons dashicons-dismiss"></i><a href="#" class="gdpr-cookies-gtm-remove-purpose-js">Remove</a></span>
                  <?php endif; ?>

                </p>

              <?php endforeach; ?>

            <?php else : ?>
              <p>
                <label for="gdpr-cookies-gtm-purposes">
                  <input type="text" name="gdpr-cookies-gtm-purposes[0][id]" value="<?php echo (array_key_exists('container-id', $dataFromOptionsTable)) ? $dataFromOptionsTable['container-id'] : "" ?>" placeholder="sample-handle" disabled />
                  <input type="text" name="gdpr-cookies-gtm-purposes[0][name]" value="<?php echo (array_key_exists('container-id', $dataFromOptionsTable)) ? $dataFromOptionsTable['container-id'] : "" ?>" placeholder="Sample Handle" />
                </label>

              </p>
            <?php endif; ?>
          </div>
          <p>
            <span>
              <i class="dashicons dashicons-plus-alt"></i>
              <a href="#" id="gdpr-cookies-gtm-add-purpose" class="gdpr-cookies-gtm-add-purpose-js">
                <?php _e('Add another cookie purpose', 'gdpr-cookies-gtm') ?>
              </a>
            </span>
          </p>
        </div>
      </div>
      <?php
      wp_nonce_field('gdpr-cookies-gtm-settings-save', 'gdpr-cookies-gtm-settings');
      submit_button();
      ?>
    </div>
  </form>

</div><!-- .wrap -->
