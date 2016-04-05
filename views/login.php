<html>
<head>

<link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">

<script src="<?php echo base_url("assets/js/jquery.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>

</head>
<body>
<br><br>
<div class="container-fluid">

	<div class="row">
		<div class="col-sm-4 col-sm-offset-4">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h1 class="panel-title"><?php echo lang('login_heading');?></h1>
				</div>
				<div class="panel-body">
					<p><?php echo lang('login_subheading');?></p>
					<div class="row">
						<div id="infoMessage" class="col-sm-12"><p><?php echo $message;?></p></div>

						<?php echo form_open("hackathers/login", ["class" => "form-horizontal col-sm-12"]);?>

						<div class="form-group">
							<?php echo lang('login_identity_label', 'identity', ["class" => "col-sm-3 control-label"]);?>
							<div class="col-sm-9">
								<?php echo form_input($identity, $identity["value"], ["class" => "form-control"]);?>
							</div>
						</div>

						<div class="form-group">

							<?php echo lang('login_password_label', 'password', ["class" => "col-sm-3 control-label"]);?>
							<div class="col-sm-9">
								<?php echo form_input($password, "", ["class" => "form-control"]);?>
							</div>
						</div>
						<?php echo form_submit('submit', lang('login_submit_btn'), ["class" => "btn btn-primary col-sm-12 col-sm-offset-0"]);?>

						<div class="col-sm-4 col-sm-offset-0">
							<div class="checkbox">
								<label>
								<?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?> Remember me
								</label>
							</div>
						</div>
						<div class="col-sm-offset-4 col-sm-4" style="padding-top: 7px">
							<a href="forgot_password"><?php echo lang('login_forgot_password');?></a>
						</div>

						<?php echo form_close();?>

						
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</body>
</html>
