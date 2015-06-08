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
			$prepath = $root . '/bundle/' . $_GET['bundle'];
			$presub = "";
			$i = 0;
			while (isset($_GET['sub'.$i])) {
				$prepath .= '/' . $_GET['sub' . $i];
				$presub .= '&sub' . $i . '=' . $_GET['sub'.$i];
				$i++;
			}
			$path = correctpath($prepath);
			if ($handle = opendir($path)) {
			    while (false !== ($entry = readdir($handle))) {
			        if ($entry != "." && $entry != ".." && $entry !== "default." . $active_tab) {
			        	echo "<tr>";
			            echo "<td>$entry</td>";
			            echo '<td style="text-align: right;">';
			            $presub .= '&sub' . $i . '=' . $entry;
			            if (is_file(correctpath($path . "/" . $entry))) echo '<a href="?page=sslcom_cc&tab=' . $active_tab . '&bundle=' . $_GET['bundle'] . '&edit=' . $entry .  '">Edit</a> ';
			            else echo '<a href="?page=sslcom_cc&tab=' . $active_tab . '&bundle=' . $_GET['bundle'] . $presub . '">Browse</a> ';
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