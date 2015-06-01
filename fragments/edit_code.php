<br>
<?php
	$codeFile = dirname(dirname(__FILE__)) . "\\" . $active_tab . "\\" . $_GET["edit"];
	echo '<form action="' . get_site_url() . '/wp-content/plugins/sslcom-custom-code/actions/save_code.php">';
	echo '<input type="text" name="title" size="30" id="title" spellcheck="true" autocomplete="off" value="'. $_GET["edit"] . '">';
	echo '<input name="type" value="' . $active_tab . '" style="display:none">'
?>
<br><br>
<textarea name="code" rows="10" cols="30"><?php echo file_get_contents($codeFile); ?></textarea>
<br>
<button class="button button-primary button-large">Save .<?php echo $active_tab ?> file</button>
</form>