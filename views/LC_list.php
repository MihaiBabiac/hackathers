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



	table.lc-list-table > tbody > tr:nth-child(1) {
		background: #5b9bd5;
    	color: black;
	}

	table.lc-list-table > tbody > tr:nth-child(2n+2) {
		background: #DDEBF7;
    	color: black;
	}

	table.lc-list-table > tbody > tr:nth-child(2n+2):hover {
		background: #c1daf0;
	}

	table.lc-list-table > tbody > tr:nth-child(2n+3) {
		background: #f5faff;
    	color: black;
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
	xhr.addEventListener("load", function(){update_table();});
	xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xhr.send(post_data);
}

function shred_lc(){
	var xhr = new XMLHttpRequest();
	xhr.open("get", "shred_lc/" + lc_to_shred);
	xhr.addEventListener("load", function(){update_table();});
	xhr.send();
	lc_to_shred = -1;
}

function get_lc_list(async)
{
	if(async === undefined)
		async = true;

	var xhr = new XMLHttpRequest();
	xhr.open("get", "lcs_json", async);
	xhr.send();

	if (xhr.status === 200)
	{
		return JSON.parse(xhr.responseText);
	}
	else
	{
		return undefined;
	}
}

function get_current_board_change(lc_id, async)
{
	if(async === undefined)
		async = true;

	var xhr = new XMLHttpRequest();
	xhr.open("get", "current_board_change_json/" + lc_id, async);
	xhr.send();

	if (xhr.status === 200)
	{
		return JSON.parse(xhr.responseText);
	}
	else
	{
		return undefined;
	}
}



function update_table()
{
	var table = document.getElementById("lc_list_table");

	var lc_list = get_lc_list(false);

	var html = "<tr>" +
				"<th>Internal name</th>" +
				"<th>Registration name</th>" +
				"<th>City</th>" +
				"<th>Address</th>" +
				"<th>Post code</th>" +
				"<th>Email</th>" +
				"<th>Website</th>" +
				"<th></th>" +
				"</tr>";

	for(var i = 0; i < lc_list.length; i++)
	{
		var id = lc_list[i].lc_id;

		html += "<tr>";


		html += "<td role='button' data-toggle='collapse' href='#collapseExample"+ id + "'>" 
				+ lc_list[i].lc_internal_name + "</td>";
		html += "<td role='button' data-toggle='collapse' href='#collapseExample"+ id + "'>" 
				+ lc_list[i].lc_reg_name + "</td>";
		html += "<td role='button' data-toggle='collapse' href='#collapseExample"+ id + "'>" 
				+ lc_list[i].lc_city + "</td>";
		html += "<td role='button' data-toggle='collapse' href='#collapseExample"+ id + "'>" 
				+ lc_list[i].lc_address + "</td>";
		html += "<td role='button' data-toggle='collapse' href='#collapseExample"+ id + "'>" 
				+ lc_list[i].lc_post_code + "</td>";
		html += "<td role='button' data-toggle='collapse' href='#collapseExample"+ id + "'>" 
				+ lc_list[i].lc_email + "</td>";
		html += "<td role='button' data-toggle='collapse' href='#collapseExample"+ id + "'>" 
				+ lc_list[i].lc_site + "</td>";


		// Buttons

		html += "<td>";
		html += "<div class='btn-toolbar' role='toolbar'>";
		html += "<div class='btn-group' role='group'>";
		html += "<button type='button' class='btn btn-default btn-sm' data-toggle='modal' data-target='.modal-add-lc'>";
		html += "<span class='glyphicon glyphicon-pencil' aria-hidden='true'></span>";
		html += "</button>";

		html += "<a href='history/" + id + "'><button type='button' class='btn btn-default btn-lg btn-sm'>";
		html += "<span class='glyphicon glyphicon-film'></span>";
		html += "</button></a>";
		html += "</div>";

		html += "<button type='button' class='btn btn-default btn-sm' onclick='lc_to_shred=" +  id + ";' data-toggle='modal' data-target='.shred-lc-modal'>";
		html += "<span class='glyphicon glyphicon-fire' aria-hidden='true'></span>";
		html += "</button>";
		html += "</div>";
		html += "</td>";

		// buttons end


		html += "</tr>";

		html += "<tr class='collapse' id='collapseExample" + id + "'><td colspan='9'>";
		html += lc_list[i].lc_connection + "<br>";

		html += "<div class='panel panel-default'>";
		html += "<div class='panel-heading' id='current_board_date" + id + "'>" + "</div>";

		html += "<table class='table table-hover current-board-table' id='current_board" + id + "'>";
		html += "</table>";
		html += "</div>";
		html += "</td>";

		html += "</tr>";
	}
	table.innerHTML = html;

	for(var i = 0; i < lc_list.length; i++)
	{
		var id = lc_list[i].lc_id;
		update_current_board(id);
	}
}


function update_current_board(lc_id)
{
	var data = get_current_board_change(lc_id, false);

	header = document.getElementById("current_board_date" + lc_id);
	table = document.getElementById("current_board" + lc_id);
	if(data.board_change)
	{
		header.innerHTML = "Current board (since " + data.board_change.board_change_date + ")";

		if(data.board)
		{
			var html =  "<tr>" +
						"<th>Position</th>" +
						"<th>Name</th>" +
						"<th>E-mail</th>" +
						"<th>Phone</th>" +
						"</tr>";

			for(var i = 0; i < data.board.length; i++)
			{
				html += "<tr>";
				
				html += "<td>" + data.board[i].position_title + "</td>";
				html += "<td>" + data.board[i].position_name + "</td>";
				html += "<td>" + data.board[i].position_mail + "</td>";
				html += "<td>" + data.board[i].position_phone + "</td>";

				html += "</tr>";
			}

			table.innerHTML = html;
		}
		else
		{
			table.innerHTML = "";
		}
	}
	else
	{
		header.innerHTML = "";
		table.innerHTML = "";
	}
}
</script>

</head>
<body onload="update_table();">
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


<table class='table table-striped lc-list-table' id='lc_list_table'>
</table>
<br><br><br>

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
            	Shredding means permanently deleting all data about this LC from the database.
            	There is no way to recover this information later.
            	<br>
            	Are you really sure this is what you want to do?
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