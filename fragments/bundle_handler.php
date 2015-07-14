<?php
function rrmdir($dir) {
	if (is_dir($dir)) {
		$objects = scandir($dir);
		foreach ($objects as $object) {
			if (($object != "." && $object != "..") && filetype($dir . "/" . $object) == "dir") {
				rrmdir($dir . "/" . $object);
			} else {
				unlink($dir . "/" . $object);
			}
		}
		reset($objects);
		rmdir($dir);
	}
}
$path = dirname(__FILE__);
if (isset($_GET['delete'])) {
	$folder = correctpath($root . "/bundle/" . $_GET['delete']);
	if (is_dir($folder)) {
		rrmdir($folder);
		echo '<div class="updated"><p>$folder has been deleted</p></div>';
		include_once correctpath($path . '/list_bundles.php');
	}
} elseif (isset($_GET['bundle']) && $_GET['bundle'] !== '') {
	if (isset($_GET['folder'])) {
		include_once correctpath($path . '/new_folder.php');
	} else {
		include_once correctpath($path . '/browse_bundle.php');
	}
} elseif (isset($_GET['bundle']) && $_GET['bundle'] == '') {
	include_once correctpath($path . '/new_bundle.php');
} else {
	include_once correctpath($path . '/list_bundles.php');
}
?>