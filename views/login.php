<html>
<head>

<link href="<?php echo base_url("assets/css/bootstrap.min.css"); ?>" rel="stylesheet">

<script src="<?php echo base_url("assets/js/jquery.min.js"); ?>"></script>
<script src="<?php echo base_url("assets/js/bootstrap.min.js"); ?>"></script>

</head>
<body>

<h1><?php echo lang('login_heading');?></h1>
<p><?php echo lang('login_subheading');?></p>

<div id="infoMessage"><?php echo $message;?></div>

<?php echo form_open("hackathers/login", ["class" => "form-horizontal"]);?>

  <div class="form-group">
    <?php echo lang('login_identity_label', 'identity', ["class" => "col-sm-2 control-label"]);?>
    <div class="col-sm-8">

    <?php echo form_input($identity, $identity["value"], ["class" => "form-control"]);?>
	</div>
  </div>

  <div class="form-group">

    <?php echo lang('login_password_label', 'password', ["class" => "col-sm-2 control-label"]);?>
    <div class="col-sm-8">

    <?php echo form_input($password, "", ["class" => "form-control"]);?>
    </div>
  </div>
  <div class="form-group">
              <?php echo lang('login_remember_label', 'remember', ["class" => "col-sm-2 control-label"]);?>

    <div class="col-sm-8">

      <div class="checkbox">
    <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>

  </div>
  </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-8">
  <?php echo form_submit('submit', lang('login_submit_btn'), ["class" => "btn btn-default"]);?>
   </div>
  </div>
<?php echo form_close();?>

<div class="col-sm-offset-2 col-sm-8">
<a href="forgot_password"><?php echo lang('login_forgot_password');?></a>
</div>

</body>
</html>
