<br>
<a class="button button-primary button-large">Save .<?php echo $active_tab ?> file</a>
<br><br>
<?php echo '<input type="text" name="title" size="30" id="title" spellcheck="true" autocomplete="off" value="'. $_GET["edit"] . '">' ?>
<br><br>
<?php
	$codeFile = dirname(dirname(__FILE__)) . "\\" . $active_tab . "\\" . $_GET["edit"];
	$fh = fopen($codeFile, 'r+');
	$theData = fread($fh, filesize($codeFile));
	fclose($fh);
?>
<textarea rows="10" cols="30"><?php echo $theData ?></textarea>