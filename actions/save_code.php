<?php
	$codeFile = dirname(dirname(__FILE__)) . "\\" . $_GET["type"] . "\\" . $_GET["title"];
	file_put_contents($codeFile, $_GET["code"]);
?>