<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</head>
<body>

<h1><?=$LC->lc_internal_name;?></h1><br>

<?php 
/*$data["board_changes"] = $board_changes;
		$data["boards"] = $boards;
		$data["LC"] = $LC;
		*/
foreach($board_changes as $key => $value)
{
?>
<div class="panel panel-default">
	<!-- Default panel contents -->
	<div class="panel-heading">Board Change on <?=$value->board_change_date;?></div>
	<!--<div class="panel-body">
	<p>...</p>
	</div>-->

	<!-- Table -->
	<table class="table">
	<?php
	if(array_key_exists($key, $boards))
	{
		foreach($boards[$key] as $position)
		{
			echo "<tr>";

			foreach ($position as $key1 => $value1) {
				if($key1 == "position_id" || $key1 == "board_change_id")
					continue;
				echo "<td>" . $value1 . "</td>";
			}
			echo "</tr>";
		}
	}
	?>
	</table>
</div>

<?php
}
?>


