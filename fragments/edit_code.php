<br>
<?php
	function getCurrentURL()
	{
	    $currentURL = (@$_SERVER["HTTPS"] == "on") ? "https://" : "http://";
	    $currentURL .= $_SERVER["SERVER_NAME"];
	 
	    if($_SERVER["SERVER_PORT"] != "80" && $_SERVER["SERVER_PORT"] != "443")
	        $currentURL .= ":".$_SERVER["SERVER_PORT"];
	 
        $currentURL .= $_SERVER["REQUEST_URI"];
	    return $currentURL;
	}
	function redirect($url){
		if (headers_sent()){
			die('<script type="text/javascript">window.location.href="' . $url . '";</script>');
		}else{
			header('Location: ' . $url);
			die();
		}    
	}
	//Write code to file
	if (isset($_POST["title"])) {
		$writeFile = dirname(dirname(__FILE__)) . "\\" . $active_tab . "\\" . $_POST["title"];
		$code = stripslashes($_POST["code"]);
		file_put_contents($writeFile, $code);
		//Redirect to edit inputted file name
		if ($_GET["edit"] !== "") redirect(str_replace($_GET["edit"], $_POST["title"], getCurrentURL()));
		else redirect(getCurrentURL() . "=" . $_POST["title"]);
	}
	//Load code to screen
	$codeFile = dirname(dirname(__FILE__)) . "\\" . $active_tab . "\\" . $_GET["edit"];
	echo '<form method="post" action="">';
	echo '<input type="text" name="title" size="30" id="title" spellcheck="true" autocomplete="off" placeholder="Enter file name here" value="'. (($_GET["edit"] !== "") ? $_GET["edit"] : "") . '">';
?>
<br><br>
<textarea name="code" rows="10" cols="30" placeholder="Enter code here"><?php if ($_GET["edit"] !== "") echo file_get_contents($codeFile); ?></textarea>
<br>
<button class="button button-primary button-large">Save .<?php echo $active_tab ?> file</button>
</form>