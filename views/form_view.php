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
	  <h1>Add new commitment</h1>
	</div>

	
<div class="container">
  <form role="form">
    <div class="form-group">
      <label for="usr">Internal name:</label>
      <input type="text" class="form-control" id="lc_internal_name">
    </div>
    <div class="form-group">
      <label for="pwd">Registration name:</label>
      <input type="password" class="form-control" id="lc_reg_name">
    </div>
    <div class="form-group">
      <label for="pwd">Connection name:</label>
      <input type="text" class="form-control" id="lc_connection">
    </div>
    <div class="form-group">
      <label for="pwd">Address:</label>
      <input type="text" class="form-control" id="lc_address">
    </div>
    <div class="form-group">
      <label for="pwd">Post code:</label>
      <input type="text" class="form-control" id="lc_post_code">
    </div>
    <div class="form-group">
      <label for="pwd">City:</label>
      <input type="text" class="form-control" id="lc_city">
    </div>
    <div class="form-group">
      <label for="pwd">E-mail:</label>
      <input type="text" class="form-control" id="lc_email">
    </div>
    <div class="form-group">
      <label for="pwd">Website:</label>
      <input type="text" class="form-control" id="lc_site">
    </div>
    <div class="form-group">
      <input type="submit" class="form-control" value="Add">
    </div>
	
  </form>
</div>
</body>
</html>



<!--
<html>
<body>

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

</body>
</html>
-->