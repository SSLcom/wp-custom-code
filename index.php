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

function correctpath($path) {
	return str_replace(array('/', '\\'), DIRECTORY_SEPARATOR, $path);
}

function urifriendly($path) {
	return str_replace('\\', '/', $path);
}

function strhas($haystack, $needle) {
	if (gettype($needle) != "array") {
		return (strpos($haystack, $needle) !== false);
	}

	foreach ($needle as $n) {
		if (strpos($haystack, $n) !== false) {
			return true;
		}
	}

}

function getPubPath($fstring) {
	$str = urifriendly($fstring);
	$pos = strpos($str, "bundle");
	return substr($str, $pos);
}

function getAbsPath($fstring, $name) {
	$cstring = __FILE__;
	$cstr = urifriendly(preg_replace("#[A-Z]:[\\\/]#", '', $cstring));
	$bloc = plugins_url() . '/sslcom-custom-code/bundle/' . $name;
	$fpath = getPubPath($fstring);
	if (strhas($fpath, '../')) {
		$lpos = strrpos($fpath, '../') + 3;
		$fend = substr($fpath, $lpos);
		$upcount = substr_count($fpath, '../');
		$base = dirname($cstr);
		for ($i = 0; $i < $upcount; $i++) {
			$base = dirname($base);
		}

		return urifriendly($bloc . $base . '/' . $fend);
	} elseif (strhas($fpath, './') || !strhas($fpath, '/')) {
		$lpos = strrpos($fpath, './') + 1;
		$fend = substr($fpath, $lpos);
		return $bloc . $fend;
	} elseif (strhas($fpath, '/')) {
		return $bloc . '/' . $fpath;
	}

	return false;
}

function return_code($atts, $content = null, $tag) {
	global $a;
	$a = shortcode_atts(array('name' => 'default'), $atts);
	if ($tag !== "bundle") {
		$fpath = (strpos($a['name'], '.' . $tag) !== false) ? correctpath(dirname(__FILE__) . '/' . $tag . '/' . $a['name']) : correctpath(dirname(__FILE__) . '/' . $tag . '/' . $a['name'] . '.' . $tag);
	}

	switch ($tag) {
		case "bundle":
			function path($path) {
				global $a;
				echo getAbsPath($path, $a['name']);
			}
			$fpath = correctpath(dirname(__FILE__) . '/' . $tag . '/' . $a['name']);
			$hasfile = false;
			if (is_dir($fpath)) {
				$fpriority = array("index.php", "index.html", "default.php", "default.html", $a['name'] . ".php", $a['name'] . ".html");
				foreach ($fpriority as $f) {
					if (file_exists($fpath . '/' . $f)) {
						include_once $fpath . '/' . $f;
						$hasfile = true;
						break;
					}
				}
			}
			if (!$hasfile) {
				echo "The bundle name you have entered does not exist";
			}

			break;

		case "html";
		case "php":
			if (file_exists($fpath)) {
				include_once $fpath;
			} else {
				echo "The file name you have entered does not exist.";
			}

			break;

		case "css":
			$fpath = plugins_url() . '/sslcom-custom-code/' . $tag . '/' . $a['name'] . '.' . $tag;
			return '<link rel="stylesheet" href="' . $fpath . '">';
			break;

		case "js":
			$fpath = plugins_url() . '/sslcom-custom-code/' . $tag . '/' . $a['name'] . '.' . $tag;
			return '<script src="' . $fpath . '"></script>';
			break;

		default:
			echo 'No tag specified? How? What even? You really shouldn\'t be seeing this.
				<br>I\'d recommend you go buy yourself an SSL certificate from <a href="https://www.ssl.com">SSL.com</a>'	;
	}
}

add_shortcode('html', 'return_code');
add_shortcode('php', 'return_code');
add_shortcode('css', 'return_code');
add_shortcode('js', 'return_code');
add_shortcode('bundle', 'return_code');

/* Add Menus
-----------------------------------------------------------------*/
add_action('admin_menu', 'ch_essentials_admin');
function ch_essentials_admin() {

	/* Base Menu */
	add_menu_page('SSL.com Custom Code', 'SSL.com Custom Code', 'manage_options', 'sslcom_cc', 'sslcom_cc_index');
}

/* Display Page
-----------------------------------------------------------------*/
function sslcom_cc_index() {
	include_once correctpath(dirname(__FILE__) . '/' . "options.php");
}
?>