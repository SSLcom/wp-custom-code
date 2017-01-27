<?php
error_reporting(-1);

$uploaddir = correctpath(dirname(plugin_dir_path(__FILE__)) . '/bundle/');
if (isset($_POST['title']) && $_POST['title'] != '') {
	mkdir($uploaddir . $_POST['title'], 0755);
} elseif (isset($_FILES['fileToUpload'])) {
	$uploadfile = $uploaddir . basename($_FILES['fileToUpload']['name']);
	if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $uploadfile)) {
		$file = $uploadfile;

		// get the absolute path to $file
		$path = pathinfo(realpath($file), PATHINFO_DIRNAME);

		$zip = new ZipArchive;
		$res = $zip->open($file);
	  	$message = $res;
		if ($res === TRUE) {
			// extract it to the path we determined above
			$zip->extractTo($path);
			$zip->close();
		  	$message = $zip->getStatusString();
		  	unlink(realpath($file));
		  	redirect("?page=sslcom_cc&tab=bundle");
		} else {
		  $message = "Zip Invalid";
		  unlink($path);
		}	  	
	} else {
	  	$message = "File failed to upload";
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
<h1><?php echo $message ?></h1>