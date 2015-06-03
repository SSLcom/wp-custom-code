<br>
<a href="?page=sslcom_cc&tab=<?php echo $active_tab ?>&bundle<?php echo $_GET['bundle'] ?>" class="button button-primary button-large">Create new folder</a>
<a href="?page=sslcom_cc&tab=<?php echo $active_tab ?>&bundle<?php echo $_GET['bundle'] ?>" class="button button-primary button-large">Create new file</a>
<br><br>
<table class="wp-list-table widefat fixed striped">
	<thead>
		<th>File/Folder name</th>
		<th style="text-align: right;">Options</th>
	</thead>
	<tbody>
		<?php
			if ($handle = opendir(correctpath($root . '/bundle/' . $_GET['bundle']))) {
			    while (false !== ($entry = readdir($handle))) {
			        if ($entry != "." && $entry != ".." && $entry !== "default." . $active_tab) {
			        	echo "<tr>";
			            echo "<td>$entry</td>";
			            echo '<td style="text-align: right;"><a href="?page=sslcom_cc&tab=' . $active_tab . '&bundle=' . $entry . '">Edit</a> ';
			            echo '<a href="?page=sslcom_cc&tab=' . $active_tab . '&delete=' . $entry . '">Delete</a></td>';
			            echo '</tr>';
			        }
			    }
			    closedir($handle);
			}
		?>
	</tbody>
</table>