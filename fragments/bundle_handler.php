<?php
if (isset($_GET['delete'])) {
	$folder = correctpath($path . "/bundle/" . $_GET['delete']);
	if (is_dir($folder)) {
		rmdir($folder);
		include_once(correctpath($path . '/list_bundles.php'));
	}
}elseif (isset($_GET['bundle']) && $_GET['bundle'] !== '') {
	include_once(correctpath($path . '/browse_bundle.php'));
}
elseif (isset($_GET['bundle']) && $_GET['bundle'] == '') {
	include_once(correctpath($path . '/new_bundle.php'));
}
else { 
	include_once(correctpath($path . '/list_bundles.php'));
}

?>