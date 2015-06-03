<?php
	/*
	Plugin Name: SSL.com Custom Code
	Plugin URI: https://www.ssl.com
	Description: A plugin by SSL.com that allows you to insert custom HTML, PHP, CSS, and JavaScript via shortcodes
	Version: 0.2.1
	Author: SSL.com
	Author URI: https://www.ssl.com
	License: MIT
	*/

	$path = dirname(__FILE__);

	function return_code($atts, $content = null, $tag) {
		$a = shortcode_atts(array('name'=>'default'), $atts);
		$fpath = realpath(dirname(__FILE__) . '/' . $tag . '/' . $a['name'] . '.' . $tag);
		switch($tag) {
			case "html";
			case "php" : 
				if (file_exists($fpath)) include_once($fpath);
				else echo "The file name you have entered does not exist.";
				break;
			case "css" : 
				$fpath = get_site_url() . '/wp-content/plugins/sslcom-custom-code/' . $tag . '/' . $a['name'] . '.' . $tag;
				return '<link rel="stylesheet" href="' . $fpath . '">';
				break;
			case "js" : 
				$fpath = get_site_url() . '/wp-content/plugins/sslcom-custom-code/' . $tag . '/' . $a['name'] . '.' . $tag;
				return '<script src="' . $fpath . '"></script>';
				break;
			default : 
				echo 'No tag specified? How? What even? You really shouldn\'t be seeing this.
				<br>I\'d recommend you go buy yourself an SSL certificate from <a href="https://www.ssl.com">SSL.com</a>';
		}
		
	}
	
	add_shortcode('html', 'return_code');
	add_shortcode('php', 'return_code');
	add_shortcode('css', 'return_code');
	add_shortcode('js', 'return_code');

	/* Add Menus
	-----------------------------------------------------------------*/
	add_action('admin_menu', 'ch_essentials_admin');
	function ch_essentials_admin() {
	    /* Base Menu */
	    add_menu_page(
	    'SSL.com Custom Code',
	    'SSL.com Custom Code',
	    'manage_options',
	    'sslcom_cc',
	    'sslcom_cc_index');
	}

	/* Display Page
	-----------------------------------------------------------------*/
	function sslcom_cc_index() {
		include_once(realpath(dirname(__FILE__) . '/' . "options.php"));
	}
?>