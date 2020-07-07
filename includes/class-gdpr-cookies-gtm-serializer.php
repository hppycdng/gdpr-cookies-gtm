<?php

/**
 * Performs all sanitization functions required to save the option values to
 * the database.
 *
 * This will also check the specified nonce and verify that the current user has
 * permission to save the data.
 *
 * @package    Gdpr_Cookies_Gtm
 * @subpackage Gdpr_Cookies_Gtm/includes
 */

class Gdpr_Cookies_Gtm_Serializer
{

  /**
   * Initializes the function by registering the save function with the
   * admin_post hook so that we can save our options to the database.
   */
  public function init()
  {
    add_action('admin_post', array($this, 'save'));
  }

  /**
   * Recursive sanitation for an array
   *
   * @param $array
   *
   * @return mixed
   */
  public function recursive_sanitize_text_field($array)
  {
    foreach ($array as $key => &$value) {
      if (is_array($value)) {
        $value = $this->recursive_sanitize_text_field($value);
      } else {
        $value = sanitize_text_field($value);
      }
    }

    return $array;
  }

  /**
   * Validates the incoming nonce value, verifies the current user has
   * permission to save the value from the options page and saves the
   * option to the database.
   */
  public function save()
  {

    // First, validate the nonce and verify the user as permission to save.
    if (!($this->has_valid_nonce() && current_user_can('manage_options'))) {
      // TODO: Display an error message.
    }

    $dataToSerialize = array();

    $dataToSerialize["is-active"]        = (null !== wp_unslash($_POST['gdpr-cookies-gtm-is-active']) && $_POST['gdpr-cookies-gtm-is-active'] === "is-active") ? 1 : 0;
    $dataToSerialize["container-id"]     = (null !== wp_unslash($_POST['gdpr-cookies-gtm-container-id'])) ? sanitize_text_field($_POST['gdpr-cookies-gtm-container-id']) : "";
    $dataToSerialize["banner-headline"]  = (null !== wp_unslash($_POST['gdpr-cookies-gtm-banner-headline'])) ? sanitize_text_field($_POST['gdpr-cookies-gtm-banner-headline']) : "";
    $dataToSerialize["banner-copy-text"] = (null !== wp_unslash($_POST['gdpr-cookies-gtm-banner-copy-text'])) ? sanitize_textarea_field($_POST['gdpr-cookies-gtm-banner-copy-text']) : "";
    $dataToSerialize["purposes"] = (null !== wp_unslash($_POST['gdpr-cookies-gtm-purposes'])) ?
      array_values(array_filter($this->recursive_sanitize_text_field($_POST['gdpr-cookies-gtm-purposes']))) : "";

    $dataToStore = serialize($dataToSerialize);
    update_option('gdpr-cookies-gtm-settings', $dataToStore);

    $this->redirect();
  }

  /**
   * Determines if the nonce variable associated with the options page is set
   * and is valid.
   *
   * @access private
   *
   * @return boolean False if the field isn't set or the nonce value is invalid;
   *                 otherwise, true.
   */
  private function has_valid_nonce()
  {

    // If the field isn't even in the $_POST, then it's invalid.
    if (!isset($_POST['gdpr-cookies-gtm-settings'])) { // Input var okay.
      return false;
    }

    $field  = wp_unslash($_POST['gdpr-cookies-gtm-settings']);
    $action = 'gdpr-cookies-gtm-settings-save';

    return wp_verify_nonce($field, $action);
  }

  /**
   * Redirect to the page from which we came (which should always be the
   * admin page. If the referred isn't set, then we redirect the user to
   * the login page.
   *
   * @access private
   */
  private function redirect()
  {

    // To make the Coding Standards happy, we have to initialize this.
    if (!isset($_POST['_wp_http_referer'])) { // Input var okay.
      $_POST['_wp_http_referer'] = wp_login_url();
    }

    // Sanitize the value of the $_POST collection for the Coding Standards.
    $url = sanitize_text_field(
      wp_unslash($_POST['_wp_http_referer']) // Input var okay.
    );

    // Finally, redirect back to the admin page.
    wp_safe_redirect(urldecode($url));
    exit;
  }
}
