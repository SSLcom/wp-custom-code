<?php
$prepath = $root . '/bundle/' . $_GET['bundle'];
$presub = "";
$i = 0;
while (isset($_GET['sub' . $i])) {
	$prepath .= '/' . $_GET['sub' . $i];
	$presub .= '&sub' . $i . '=' . $_GET['sub' . $i];
	$i++;
}
if (isset($_POST['title']) && $_POST['title'] != '') {
	mkdir($prepath . '/' . $_POST['title'], 775);
	redirect('?page=sslcom_cc&tab=' . $active_tab . '&bundle=' . $_GET['bundle'] . $presub);
}
?>
<form method="post" action="" enctype="multipart/form-data">
	<input type="text" name="title" size="30" id="title" spellcheck="true" autocomplete="off" placeholder="Enter folder name here">
    	<br><br>
    	<input type="submit" class="button button-primary button-large" value="Create Folder" name="submit">
</form>