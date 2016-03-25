<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>

<style>
	div.right {
		float: right;
	}
	div.inline {
		display: inline;
	}
</style>


</head>
<body>
  <div class="inline"> 
	  <div class="right"> 
		<button type='button' class='btn btn-default btn-xs'>
		  <span class='glyphicon glyphicon-off' aria-hidden='true'></span> Log out
		</button>
	  </div>	
	  <h1>List of commitments</h1>
  </div>
  <br>
  <div class="right"> 
	<button type='button' class='btn btn-default btn-sm'>
	  <span class='glyphicon glyphicon-plus' aria-hidden='true'></span> Add commitment
	</button>
  </div>


<?php

$description = array
('lc_id' => "ID",
 'lc_internal_name' => "Internal name",
 'lc_reg_name' => "Registration name",
 'lc_connection' => "Connection name",
 'lc_address' => "address",
 'lc_post_code' => "Post code",
 'lc_city' => "City",
 //country
 'lc_email' => "email",
 'lc_site' => "website",
 );

$i = 0;



echo "<table class='table table-hover'>";

foreach ($LC as $row)
{
	if($i == 0)
	{
		echo "<tr>";
		foreach($row as $key => $value)
		{
			if($key == "lc_id" || $key == "lc_connection")
					continue;
			echo "<th>" . $description[$key] . "</th>";
		}
		echo "<th> </th>";
		echo "</tr>";
	}
	
	echo "<tr >";
	foreach($row as $key => $value)
	{
		if($key == "lc_id" || $key == "lc_connection")
					continue;
		echo "<td role='button' data-toggle='collapse' href='#collapseExample$i' aria-expanded='false' aria-controls='collapseExample'>" . $value . "</td>";
	}
	echo "<td>
		<button type='button' class='btn btn-default btn-sm' aria-label='Left Align'>
		<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
		</button>  
		<button type='button' class='btn btn-default btn-lg btn-sm'>
		<span class='glyphicon glyphicon-film' aria-hidden='true'></span>
		</button>

		</td>";

	echo "</tr>";

	echo "<tr class='collapse' id='collapseExample$i'><td colspan='9'>";
	echo $row->lc_connection . "<br>";
	if($has_board[$row->lc_id] == 0)
		continue;
	echo "<div class='well'>";
	echo "<table class='table table-hover'>";

	$board = $current_boards[$row->lc_id];

	$j = 0;

	foreach($board as $member)
	{
		if($j == 0)
		{
			echo "<tr>";
			foreach($member as $key => $value)
			{
				if($key == "position_id" || $key == "board_change_id")
					continue;
				echo "<th>" . $key . "</th>";
			}
			echo "</tr>";
		}
		
		echo "<tr>";
		foreach($member as $key => $value)
		{
			if($key == "position_id" || $key == "board_change_id")
				continue;
			echo "<td>" . $value . "</td>";
		}
		echo "</tr>";

		$j++;

	}

	echo "</table>";
	echo "</div>";
	echo "<td></tr>";

	$i++;
}
echo "</table>";

?>
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      SomeThing
    </div>
  </div>
</div>
</body>
</html>