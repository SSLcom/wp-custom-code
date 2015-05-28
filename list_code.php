<br>
<a href="?page=sslcom_cc&tab=<?php echo $active_tab ?>&new" class="button button-primary button-large">Create new .<?php echo $active_tab ?> file</a>
<br><br>
<table class="wp-list-table widefat fixed striped">
	<thead>
		<th style="text-align: left;">File name</th>
		<th style="text-align: right;">Edit Options</th>
	</thead>
	<tbody>
		<?php
			if ($handle = opendir(dirname(__FILE__) . '\\'  . $active_tab)) {
			    while (false !== ($entry = readdir($handle))) {
			        if ($entry != "." && $entry != "..") {
			        	echo "<tr>";
			            echo "<td>$entry</td>";
			            echo '<td style="text-align: right;"><a href="?page=sslcom_cc&tab=' . $active_tab . '&edit=' . $entry . '">Edit</a> ';
			            echo '<a href="?page=sslcom_cc&tab=' . $active_tab . '&edit=' . $entry . '">Delete</a></td>';
			            echo '</tr>';
			        }
			    }
			    closedir($handle);
			}
		?>
	</tbody>
</table>