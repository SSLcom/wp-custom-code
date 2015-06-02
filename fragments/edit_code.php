<br>
<?php
	function getCurrentURL() {
	    $currentURL = get_site_url();
	 
        $currentURL .= $_SERVER["REQUEST_URI"];
	    return $currentURL;
	}
	function redirect($url) {
		echo '<script type="text/javascript">window.location.href="' . $url . '";</script>';
	}
	//Write code to file
	if (isset($_POST["title"])) {
		$code = stripslashes($_POST["code"]);
		//Check to see if file name is valid
		if ($_POST["title"] !== "" && !preg_match("/[^0-9A-Z.\-_]/i", $_POST["title"])) {
			$writeFile = dirname(dirname(__FILE__)) . "/" . $active_tab . "/" . $_POST["title"];
			file_put_contents($writeFile, $code);
			//Redirect to edit inputted file name
			if ($_GET["edit"] !== "") redirect(str_replace($_GET["edit"], $_POST["title"], getCurrentURL()));
			else redirect(getCurrentURL() . "=" . $_POST["title"]);
		}
		else echo "File name is invalid";
	}
	//Load code to screen
	$codeFile = dirname(dirname(__FILE__)) . "/" . $active_tab . "/" . $_GET["edit"];
	echo '<form method="post" action="">';
	echo '<input type="text" name="title" size="30" id="title" spellcheck="true" autocomplete="off" placeholder="Enter file name here" value="'. (($_GET["edit"] !== "") ? $_GET["edit"] : "") . '">';
	if ($_GET["edit"] !== "" && !isset($code)) $code = file_get_contents($codeFile);
?>
<br><br>
<textarea name="code" rows="10" cols="30" placeholder="Enter code here"><?php echo $code ?></textarea>
<br>
<button class="button button-primary button-large">Save .<?php echo $active_tab ?> file</button>
</form>