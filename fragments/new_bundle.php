<?php
$uploaddir = correctpath(dirname(plugin_dir_path(__FILE__)) . '/bundle/');

if (isset($_POST['title']) && $_POST['title'] != '') {
	mkdir($uploaddir . $_POST['title'], 775);

} elseif (isset($_FIlES['fileToUpload'])) {
	$uploadfile = $uploaddir . basename($_FILES['fileToUpload']['name']);
	if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadfile)) {
		$file = $uploadfile;

		// get the absolute path to $file
		$path = pathinfo(realpath($file), PATHINFO_DIRNAME);

		$zip = new ZipArchive;
		$res = $zip->open($file);
		if ($res === TRUE) {
			// extract it to the path we determined above
			$zip->extractTo($path);
			$zip->close();
		}
	}
}
?>
<form method="post" action="" enctype="multipart/form-data">
	<input type="text" name="title" size="30" id="title" spellcheck="true" autocomplete="off" placeholder="Enter bundle name here">
	<br><br>
	OR Select Zip File to upload:<br>
    	<input type="file" name="fileToUpload" id="fileToUpload">
    	<br><br>
    	<input type="submit" class="button button-primary button-large" value="Create Bundle" name="submit">
</form>