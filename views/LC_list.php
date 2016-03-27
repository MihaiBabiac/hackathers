<html>
<head>

<link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">

<script src="<?php echo base_url("assets/js/jquery.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>

<style>
	div.right {
		float: right;
	}
	div.inline {
		display: inline;
	}
</style>

<script>
var lc_to_shred = -1;

function add_lc(){
	var inputs = document.getElementsByClassName("add-lc");

	var post_data = "";

	for(var i = 0; i < inputs.length; i++)
	{
		post_data += inputs[i].name + "=" + inputs[i].value + (i != inputs.length - 1? "&" : "");
	}

	var xhr = new XMLHttpRequest();

	xhr.open("POST", "add_lc");

	//xhr.addEventListener("loadend", function(){console.log(this.responseText)});
	//xhr.addEventListener("load", function(){console.log(this.responseText);});
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send(post_data);
}

function shred_lc(){
	var xhr = new XMLHttpRequest();
	xhr.open("get", "shred_lc/" + lc_to_shred);
	xhr.send();
	lc_to_shred = -1;
}

</script>

</head>
<body>
  <div class="inline"> 
	  <div class="right"> 
		<a href="logout"><button type='button' class='btn btn-default btn-xs'>
		  <span class='glyphicon glyphicon-off'></span>Log out
		</button></a>
	  </div>	
	  <h1>List of commitments</h1>
  </div>
  <br>
  <div class="right"> 
	<button type='button' class='btn btn-default btn-sm' data-toggle='modal' data-target='.add-lc-modal'>
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
	$i++;
	if($i == 1)
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
		echo "<td role='button' data-toggle='collapse' href='#collapseExample$i'>" . $value . "</td>";
	}

	echo "<td>
	<div class='btn-toolbar' role='toolbar'>
		<div class='btn-group' role='group'>
			<button type='button' class='btn btn-default btn-sm' data-toggle='modal' data-target='.modal-add-lc'>
			<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>
			</button>

			<a href='history/$row->lc_id'><button type='button' class='btn btn-default btn-lg btn-sm'>
			<span class='glyphicon glyphicon-film'></span>
			</button></a>
		</div>
		
		<button type='button' class='btn btn-default btn-sm' onclick='lc_to_shred=$row->lc_id;' data-toggle='modal' data-target='.shred-lc-modal'>
		<span class='glyphicon glyphicon-fire' aria-hidden='true'></span>
		</button>
		<!--
		<a href='shred_lc/$row->lc_id'><button type='button' class='btn btn-default btn-lg btn-sm'>
		<span class='glyphicon glyphicon-fire'></span>
		</button></a>
		-->
	</div>
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

	
}
echo "</table>";

?>
<div class="modal fade modal-add-lc" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
		<form action="display_added_info" method="post">
		Internal name: <input type="text" name="lc_internal_name"><br>
		Registration name: <input type="text" name="lc_reg_name"><br>
		Connection name: <input type="text" name="lc_connection"><br>
		Address: <input type="text" name="lc_address"><br>
		Post code: <input type="text" name="lc_post_code"><br>
		City: <input type="text" name="lc_city"><br>
		E-mail: <input type="text" name="lc_email"><br>
		Website: <input type="text" name="lc_site"><br>
		<input type="submit" value="add">
		</form>
    </div>
  </div>
</div>


<div class="modal fade add-lc-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span>&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Add Commitment
                </h4>
            </div>
			
			<form role="form" action="add_lc" method="post">

            <div class="modal-body">
					<div class="form-group">
						<label for="lc_internal_name">Internal name:</label>
						<input type="text" class="form-control add-lc" id="lc_internal_name" name="lc_internal_name">
					</div>
					<div class="form-group">
						<label for="lc_reg_name">Registration name:</label>
						<input type="text" class="form-control add-lc" id="lc_reg_name" name="lc_reg_name">
					</div>
					<div class="form-group">
						<label for="lc_connection">Connection name:</label>
						<input type="text" class="form-control add-lc" id="lc_connection" name="lc_connection">
					</div>
					<div class="form-group">
						<label for="lc_address">Address:</label>
						<input type="text" class="form-control add-lc" id="lc_address" name="lc_address">
					</div>
					<div class="form-group">
						<label for="lc_post_code">Post code:</label>
						<input type="text" class="form-control add-lc" id="lc_post_code" name="lc_post_code">
					</div>
					<div class="form-group">
						<label for="lc_city">City:</label>
						<input type="text" class="form-control add-lc" id="lc_city" name="lc_city">
					</div>
					<div class="form-group">
						<label for="lc_email">E-mail:</label>
						<input type="text" class="form-control add-lc" id="lc_email" name="lc_email">
					</div>
					<div class="form-group">
						<label for="lc_site">Website:</label>
						<input type="text" class="form-control add-lc" id="lc_site" name="lc_site">
					</div>
					

			</div>

			<div class="modal-footer">
				<button type="button" class="btn btn-primary" onclick="add_lc()" data-dismiss="modal">Add</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
			</form>

		</div>
	</div>
</div>

<div class="modal fade shred-lc-modal" tabindex="-1" role="dialog">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
			    <h4 class="modal-title">
				Shred LC?
				</h4>
			</div>

            <div class="modal-body">
            	Are you sure you really sure this is what you want to do?
            	<br>
            	Shredding means permanently deleting all data about this LC from the database.
            	There is no way to recover this information later.
			</div>


			<div class="modal-footer">
				<button type="button" class="btn btn-danger" onclick="shred_lc()" data-dismiss="modal">Shred</button>
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>

		</div>
	</div>
</div>
</body>
</html>