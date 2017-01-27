<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Sslcom_Content_Management
 * @subpackage Sslcom_Content_Management/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Sslcom_Content_Management
 * @subpackage Sslcom_Content_Management/admin
 * @author     Your Name <email@example.com>
 */
class Sslcom_Content_ManagementAdmin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $Sslcom_Content_Management    The ID of this plugin.
	 */
	private $Sslcom_Content_Management;

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
	 * @param      string    $Sslcom_Content_Management       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $Sslcom_Content_Management, $version ) {

		$this->Sslcom_Content_Management = $Sslcom_Content_Management;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sslcom_Content_ManagementLoader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sslcom_Content_ManagementLoader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->Sslcom_Content_Management, plugin_dir_url( __FILE__ ) . 'css/sslcom-content-management-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Sslcom_Content_ManagementLoader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Sslcom_Content_ManagementLoader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->Sslcom_Content_Management, plugin_dir_url( __FILE__ ) . 'js/sslcom-content-management-admin.js', array( 'jquery' ), $this->version, false );

	}

}
