<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://happycoding.it
 * @since      1.0.0
 *
 * @package    Gdpr_Cookies_Gtm
 * @subpackage Gdpr_Cookies_Gtm/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Gdpr_Cookies_Gtm
 * @subpackage Gdpr_Cookies_Gtm/includes
 * @author     Matthias Radscheit <matthias@happycoding.it>
 */
class Gdpr_Cookies_Gtm
{

  /**
   * The loader that's responsible for maintaining and registering all hooks that power
   * the plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      Gdpr_Cookies_Gtm_Loader    $loader    Maintains and registers all hooks for the plugin.
   */
  protected $loader;

  /**
   * The unique identifier of this plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      string    $plugin_name    The string used to uniquely identify this plugin.
   */
  protected $plugin_name;

  /**
   * The current version of the plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      string    $version    The current version of the plugin.
   */
  protected $version;

  /**
   * The deserializer version of the plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      Gdpr_Cookies_Gtm_Deserializer
   */
  protected $deserializer;

  /**
   * Define the core functionality of the plugin.
   *
   * Set the plugin name and the plugin version that can be used throughout the plugin.
   * Load the dependencies, define the locale, and set the hooks for the admin area and
   * the public-facing side of the site.
   *
   * @since    1.0.0
   */
  public function __construct()
  {
    if (defined('GDPR_COOKIES_GTM_VERSION')) {
      $this->version = GDPR_COOKIES_GTM_VERSION;
    } else {
      $this->version = '1.0.0';
    }

    $this->plugin_name = 'gdpr-cookies-gtm';

    add_shortcode('gdpr-cookie-consent', array($this, 'addShortcodeForModifyingCookiePreferences'));

    $this->load_dependencies();

    $this->deserializer = new Gdpr_Cookies_Gtm_Deserializer();

    $this->set_locale();
    $this->define_admin_hooks();
    $this->define_public_hooks();
  }

  /**
   * Load the required dependencies for this plugin.
   *
   * Include the following files that make up the plugin:
   *
   * - Gdpr_Cookies_Gtm_Loader. Orchestrates the hooks of the plugin.
   * - Gdpr_Cookies_Gtm_i18n. Defines internationalization functionality.
   * - Gdpr_Cookies_Gtm_Admin. Defines all hooks for the admin area.
   * - Gdpr_Cookies_Gtm_Public. Defines all hooks for the public side of the site.
   *
   * Create an instance of the loader which will be used to register the hooks
   * with WordPress.
   *
   * @since    1.0.0
   * @access   private
   */
  private function load_dependencies()
  {

    /**
     * The class responsible for orchestrating the actions and filters of the
     * core plugin.
     */
    require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-gdpr-cookies-gtm-loader.php';

    /**
     * The class responsible for defining internationalization functionality
     * of the plugin.
     */
    require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-gdpr-cookies-gtm-i18n.php';
    /**
     * The class responsible for obtaining data from the database.
     */
    require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-gdpr-cookies-gtm-deserializer.php';
    require_once plugin_dir_path(dirname(__FILE__)) . 'includes/class-gdpr-cookies-gtm-serializer.php';

    /**
     * The class responsible for defining all actions that occur in the admin area.
     */
    require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-gdpr-cookies-gtm-submenu.php';
    require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-gdpr-cookies-gtm-submenupage.php';
    require_once plugin_dir_path(dirname(__FILE__)) . 'admin/class-gdpr-cookies-gtm-admin.php';

    /**
     * The class responsible for defining all actions that occur in the public-facing
     * side of the site.
     */
    require_once plugin_dir_path(dirname(__FILE__)) . 'public/class-gdpr-cookies-gtm-public.php';

    $this->loader = new Gdpr_Cookies_Gtm_Loader();
  }

  /**
   * Define the locale for this plugin for internationalization.
   *
   * Uses the Gdpr_Cookies_Gtm_i18n class in order to set the domain and to register the hook
   * with WordPress.
   *
   * @since    1.0.0
   * @access   private
   */
  private function set_locale()
  {

    $plugin_i18n = new Gdpr_Cookies_Gtm_i18n();

    $this->loader->add_action('plugins_loaded', $plugin_i18n, 'load_plugin_textdomain');
  }


  public function addShortcodeForModifyingCookiePreferences($atts, $content = null)
  {
    return '<a href="#" class="gdpr-cookie-consent-show-banner-js">' . $content . '</a>';
  }


  /**
   * Register all of the hooks related to the admin area functionality
   * of the plugin.
   *
   * @since    1.0.0
   * @access   private
   */
  private function define_admin_hooks()
  {

    $plugin_admin = new Gdpr_Cookies_Gtm_Admin($this->get_plugin_name(), $this->get_version(), $this->deserializer);

    $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_styles');
    $this->loader->add_action('admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts');
  }

  /**
   * Register all of the hooks related to the public-facing functionality
   * of the plugin.
   *
   * @since    1.0.0
   * @access   private
   */
  private function define_public_hooks()
  {

    $plugin_public = new Gdpr_Cookies_Gtm_Public($this->get_plugin_name(), $this->get_version(), $this->deserializer);
    $plugin_public->init();

    $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_styles');
    $this->loader->add_action('wp_enqueue_scripts', $plugin_public, 'enqueue_scripts');
  }

  /**
   * Run the loader to execute all of the hooks with WordPress.
   *
   * @since    1.0.0
   */
  public function run()
  {
    $this->loader->run();
  }

  /**
   * The name of the plugin used to uniquely identify it within the context of
   * WordPress and to define internationalization functionality.
   *
   * @since     1.0.0
   * @return    string    The name of the plugin.
   */
  public function get_plugin_name()
  {
    return $this->plugin_name;
  }

  /**
   * The reference to the class that orchestrates the hooks with the plugin.
   *
   * @since     1.0.0
   * @return    Gdpr_Cookies_Gtm_Loader    Orchestrates the hooks of the plugin.
   */
  public function get_loader()
  {
    return $this->loader;
  }

  /**
   * Retrieve the version number of the plugin.
   *
   * @since     1.0.0
   * @return    string    The version number of the plugin.
   */
  public function get_version()
  {
    return $this->version;
  }
}
