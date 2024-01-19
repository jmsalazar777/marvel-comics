<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://daxkotest.wpengine.com
 * @since      1.0.0
 *
 * @package    Marvel_Comics
 * @subpackage Marvel_Comics/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Marvel_Comics
 * @subpackage Marvel_Comics/admin
 * @author     Jean Michael Salazar
 */
class Marvel_Comics_Admin
{

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $marvel_comics    The ID of this plugin.
	 */
	private $marvel_comics;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $marvel_comics       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($marvel_comics, $version)
	{

		$this->marvel_comics = $marvel_comics;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Marvel_Comics_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Marvel_Comics_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style($this->marvel_comics, plugin_dir_url(__FILE__) . 'css/styles.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Marvel_Comics_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Marvel_Comics_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script($this->marvel_comics, plugin_dir_url(__FILE__) . 'js/scripts.js', array('jquery'), $this->version, false);
	}
}
