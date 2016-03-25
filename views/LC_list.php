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
/*foreach ($LC as $row)
{
//print_r($row);
	echo $row->lc_id;
echo "<br>";
}*/
$i = 0;



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