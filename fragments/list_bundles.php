<br>
<a href="?page=sslcom_cc&tab=<?php echo $active_tab?>&bundle" class="button button-primary button-large">Create new bundle</a>
<br><br>
<table class="wp-list-table widefat fixed striped">
	<thead>
		<th>Bundle name</th>
		<th>Shortcode</th>
		<th style="text-align: right;">Options</th>
	</thead>
	<tbody>
<?php
if ($handle = opendir(correctpath($root . '/bundle'))) {
	while (false !== ($entry = readdir($handle))) {
		if ($entry != "." && $entry != ".." && $entry != ".DS_Store" && $entry !== "default." . $active_tab) {
			echo "<tr>";
			echo "<td>$entry</td>";
			echo "<td>[$active_tab name=$entry]</td>";
			echo '<td style="text-align: right;">';
			echo '<a href="?page=sslcom_cc&tab=' . $active_tab . '&bundle=' . $entry . '">Browse</a> ';
			echo '<a href="?page=sslcom_cc&tab=' . $active_tab . '&delete=' . $entry . '">Delete</a>';
			echo '</td>';
			echo '</tr>';
		}
	}
	closedir($handle);
}
?>
	</tbody>
</table>