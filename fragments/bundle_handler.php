<?php

if (isset($_GET['bundle']) && $_GET['bundle'] !== '') {
	if (isset($_GET['delete'])) {
		$folder = realpath(dirname(__FILE__) . "/bundle/" . $_GET['bundle']);
		if (file_exists($folder)) {
			rmdir($folder);
			include_once(realpath(dirname(__FILE__) . '/list_bundles.php'));
		}
	}
	else include_once(realpath(dirname(__FILE__) . '/browse_bundle.php'));
}
elseif (isset($_GET['bundle'])) {
	include_once(realpath(dirname(__FILE__) . '/new_bundle.php'));
}
else { 
	include_once(realpath(irname(__FILE__) . '/list_bundles.php'));
}

?>