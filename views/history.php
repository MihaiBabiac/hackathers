<html>
<head>

<link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">

<script src="<?php echo base_url("assets/js/jquery.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>

</head>
<body>

<h1><?=$LC->lc_internal_name;?></h1><br>

<?php 
/*$data["board_changes"] = $board_changes;
		$data["boards"] = $boards;
		$data["LC"] = $LC;
		*/
foreach($board_changes as $board_change)
{
?>
<div class="panel panel-default">
	<!-- Default panel contents -->
	<div class="panel-heading">Board Change on <?=$board_change->board_change_date;?></div>
	<!--<div class="panel-body">
	<p>...</p>
	</div>-->

	<!-- Table -->
	<table class="table">
	<?php
	if(array_key_exists($board_change->board_change_id, $boards))
	{
		foreach($boards[$board_change->board_change_id] as $position)
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


