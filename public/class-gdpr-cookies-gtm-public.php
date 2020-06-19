<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://happycoding.it
 * @since      1.0.0
 *
 * @package    Gdpr_Cookies_Gtm
 * @subpackage Gdpr_Cookies_Gtm/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Gdpr_Cookies_Gtm
 * @subpackage Gdpr_Cookies_Gtm/public
 * @author     Matthias Radscheit <matthias@happycoding.it>
 */
class Gdpr_Cookies_Gtm_Public
{

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
       * The deserializer of this plugin.
       *
       * @since    1.0.0
       * @access   private
       * @var      Gdpr_Cookies_Gtm_Deserializer
       */

    private $deserializer;


    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct($plugin_name, $version, $deserializer)
    {
        $this->plugin_name = $plugin_name;
        $this->version = $version;
        $this->deserializer = $deserializer;
        $this->settings = $this->deserializer->get_value('gdpr-cookies-gtm-settings');
        $this->gtm_container_id = (array_key_exists('container-id', $this->settings) ? $this->settings['container-id'] :
                    "GTM-XXXXXX");
    }

    public function init()
    {
        add_action('wp_head', array($this, 'display_gtm_datalayer'));
        add_action('wp_head', array($this, 'display_gtm_script_head'));
        add_action('wp_body_open', array($this, 'display_gtm_script_body'));
        add_action('wp_body_open', array($this, 'display_cookie_banner_markup'));
    }

    public function display_gtm_datalayer()
    {
        include_once('partials/gdpr-cookies-gtm-public-gtm-datalayer.php');
    }

    public function display_gtm_script_body()
    {
        include_once('partials/gdpr-cookies-gtm-public-gtm-script-body.php');
    }

    public function display_gtm_script_head()
    {
        include_once('partials/gdpr-cookies-gtm-public-gtm-script-head.php');
    }
    public function display_cookie_banner_markup()
    {
        include_once('partials/gdpr-cookies-gtm-public-gtm-cookie-banner-markup.php');
    }




    /**
        * Register the stylesheets for the public-facing side of the site.
        *
        * @since    1.0.0
        */
    public function enqueue_styles()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Gdpr_Cookies_Gtm_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Gdpr_Cookies_Gtm_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/gdpr-cookies-gtm-public.css', array(), $this->version, 'all');
    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts()
    {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Gdpr_Cookies_Gtm_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Gdpr_Cookies_Gtm_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/gdpr-cookies-gtm-public.js', array( 'jquery' ), $this->version, false);
    }
}
