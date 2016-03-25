<html>
<body>
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

foreach ($LC as $row)
{
	echo $row->lc_internal_name . ": <br>";

	if($has_board[$row->lc_id] == 0)
		continue;
	echo "<table border='1'>";

	$board = $current_boards[$row->lc_id];

	$j = 0;

	foreach($board as $member)
	{
		if($j == 0)
		{
			echo "<tr>";
			foreach($member as $key => $value)
			{
				echo "<th>" . $key . "</th>";
			}
			echo "</tr>";
		}
		
		echo "<tr>";
		foreach($member as $value)
		{
			echo "<td>" . $value . "</td>";
		}
		echo "</tr>";

		$j++;

	}

	echo "</table>";

}
echo "<br><br><br>" ;
echo "<table border='1'>";
foreach ($LC as $row)
{
	if($i == 0)
	{
		echo "<tr>";
		foreach($row as $key => $value)
		{
			echo "<th>" . $description[$key] . "</th>";
		}
		echo "</tr>";
	}
	
	echo "<tr>";
	foreach($row as $value)
	{
		echo "<td>" . $value . "</td>";
	}
	echo "</tr>";

	$i++;
}
echo "</table>";



/*
foreach ($LC as $row)
{
	echo "LC Name: " . $row["lc_internal_name"] . "<br>";

	foreach($row["current_board"] as $position)
	{
		foreach($position as $key => $value)
		{
			echo $key . ": " . $value . "<br>";
		}
	}
	echo "<br>"
}
*/
//print_r($database_stuff->fetch_array(MYSQLI_NUM));

?>
</body>
</html>