<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<style>
	div.right {
		float: right;
	}
	div.inline {
		display: intextline;
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
	  <h1>Add new board member</h1>
	</div>

	
<div class="container">
  <form role="form">
    <div class="form-group">
      <label for="usr">Name:</label>
      <input type="text" class="form-control" id="position_name">
    </div>
    <div class="form-group">
      <label for="pwd">Mail:</label>
      <input type="password" class="form-control" id="position_mail">
    </div>
    <div class="form-group">
      <label for="pwd">Phone:</label>
      <input type="text" class="form-control" id="position_phone">
    </div>
    <div class="form-group">
      <label for="pwd">Title:</label>
      <input type="text" class="form-control" id="position_title">
    </div>
    <div class="form-group">
      <label for="pwd">Board ID:</label>
      <input type="text" class="form-control" id="board_change_id">
    </div>
    <div class="form-group">
      <input type="submit" class="form-control" value="add">
    </div>
	
  </form>
</div>
<!--
<form action="display_added_board_info" method="post">
	Name: <input type="text" name="position_name"><br>
	Mail: <input type="text" name="position_mail"><br>
	Phone: <input type="text" name="position_phone"><br>
	Title: <input type="text" name="position_title"><br>
	Board ID: <input type="text" name="board_change_id"><br> 
	<input type="submit" value="add">
</form>
-->
</body>
</html>
