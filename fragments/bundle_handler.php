<?php
if (isset($_GET['delete'])) {
	$folder = normalizePath($path . "/bundle/" . $_GET['delete']);
	if (is_dir($folder)) {
		rmdir($folder);
		include_once(normalizePath($path . '/list_bundles.php'));
	}
}elseif (isset($_GET['bundle']) && $_GET['bundle'] !== '') {
	include_once(normalizePath($path . '/browse_bundle.php'));
}
elseif (isset($_GET['bundle']) && $_GET['bundle'] == '') {
	include_once(normalizePath($path . '/new_bundle.php'));
}
else { 
	include_once(normalizePath($path . '/list_bundles.php'));
}

?>