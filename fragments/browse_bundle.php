<?php
$prepath = $root . '/bundle/' . $_GET['bundle'];
$presub = "";
$i = 0;
while (isset($_GET['sub' . $i])) {
	$prepath .= '/' . $_GET['sub' . $i];
	$presub .= '&sub' . $i . '=' . $_GET['sub' . $i];
	$i++;
}
echo '<a href="?page=sslcom_cc&tab=' . $active_tab . '&bundle=' . $_GET['bundle'] . $presub . '&folder' . '" class="button button-primary button-large">Create new folder</a> ';
echo '<a href="?page=sslcom_cc&tab=' . $active_tab . '&bundle=' . $_GET['bundle'] . $presub . '&edit' . '" class="button button-primary button-large">Create new file</a> ';
?>

<br><br>
<table class="wp-list-table widefat fixed striped">
	<thead>
		<th>File/Folder name</th>
		<th style="text-align: right;">Options</th>
	</thead>
	<tbody>
<?php
$path = correctpath($prepath);
if ($handle = opendir($path)) {
	while (false !== ($entry = readdir($handle))) {
		if ($entry != "." && $entry != ".." && $entry !== "default." . $active_tab) {
			echo "<tr>";
			echo "<td>$entry</td>";
			echo '<td style="text-align: right;">';
			if (is_file(correctpath($path . "/" . $entry))) {
				if (SSLCOM_CC_EDIT) echo '<a href="?page=sslcom_cc&tab=' . $active_tab . '&bundle=' . $_GET['bundle'] . $presub . '&edit=' . $entry . '">Edit</a> ';
			} else {
				$sub = $presub . '&sub' . $i . '=' . $entry;
				echo '<a href="?page=sslcom_cc&tab=' . $active_tab . '&bundle=' . $_GET['bundle'] . $sub . '">Browse</a> ';
			}
			if (SSLCOM_CC_EDIT) echo '<a href="?page=sslcom_cc&tab=' . $active_tab . $presub . '&delete=' . $entry . '">Delete</a>';
			echo '</td>';
			echo '</tr>';
		}
	}
	closedir($handle);
}
?>
	</tbody>
</table>