<?php
if (isset($_GET['bundle'])) {
	$prepath = $root . '/bundle/' . $_GET['bundle'];
	$presub = "";
	$i = 0;
	while (isset($_GET['sub' . $i])) {
		$prepath .= '/' . $_GET['sub' . $i];
		$presub .= '&sub' . $i . '=' . $_GET['sub' . $i];
		$i++;
	}
}
$code = "";
function getCurrentURL() {
	$currentURL = get_site_url();
	$currentURL .= $_SERVER["REQUEST_URI"];
	return $currentURL;
}
//Write code to file
if (isset($_POST["title"])) {
	$code = htmlspecialchars_decode(stripslashes($_POST["code"]));
	//Check to see if file name is valid
	if ($_POST["title"] !== "" && !preg_match("/[^0-9A-Z.\-_]/i", $_POST["title"])) {
		if (isset($_GET['bundle'])) {
			$writeFile = correctpath($prepath . '/' . $_POST["title"]);
		} else {
			$writeFile = correctpath($root . "/" . $active_tab . "/" . $_POST["title"]);
		}

		file_put_contents($writeFile, $code);
		//Redirect to edit inputted file name
		if ($_GET["edit"] !== "") {
			redirect(str_replace($_GET["edit"], $_POST["title"], getCurrentURL()));
		} else {
			redirect(getCurrentURL() . "=" . $_POST["title"]);
		}

	} else {
		echo "File name is invalid";
	}

}
//Load code to screen
if (isset($_GET['bundle'])) {
	$codeFile = correctpath($prepath . '/' . $_GET['edit']);
} else {
	$codeFile = correctpath($root . "/" . $active_tab . "/" . $_GET["edit"]);
}

echo '<form method="post" action="">';
echo '<input type="text" name="title" size="30" id="title" spellcheck="true" autocomplete="off" placeholder="Enter file name here" value="' . (($_GET["edit"] !== "") ? $_GET["edit"] : "") . '">';
if ($_GET["edit"] !== "" && (!isset($code) || $code == "")) {
	$code = file_get_contents($codeFile);
}

$code = htmlspecialchars($code);
?>
<br><br>
<textarea name="code" rows="20" placeholder="Enter code here"><?php echo $code?></textarea>
<br><br>
<button class="button button-primary button-large">Save <?php echo ($_GET['edit'] !== '') ? $_GET['edit'] : '.' . $active_tab . ' file'?></button>
</form>