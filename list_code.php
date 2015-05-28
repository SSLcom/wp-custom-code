<table style="width: 100%">
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
			            echo "<td style='width:80%'>$entry</td>";
			            echo '<td style="text-align: right;"><a href="">Edit</a> <a href="">Delete</a><td>';
			            echo "</tr>";
			        }
			    }
			    closedir($handle);
			}
		?>
	</tbody>
</table>