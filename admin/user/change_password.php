<?php
session_start();
require_once '../public/verify.php';
require_once '../public/db.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Change password</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <?php require_once '../public/style.php'; ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php require_once '../public/header.php'; ?>
<div class="wrapper">
  <?php require_once '../public/sidebar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
<div class="container">
<div class="row">
<div class="col-sm-12">
<h1>Change Password</h1>
</div>
</div>
<div class="row">
<div class="col-sm-6 col-sm-offset-3">
<p class="text-center">

<?php if (isset($_GET['passwordErr'])):?>
  <span class="text-danger"><?= $_GET['passwordErr'] ?></span>
  <?php else: ?>Enter old password and new password
<?php endif ?></p>
<form method="post" action="savepassword.php" id="passwordForm">
  <div class="form-group">
  <input type="password" class="input-lg form-control" name="password_old" id="password_old" placeholder="Old Password" autocomplete="off">
  </div>
    <div class="form-group">
<input type="password" class="input-lg form-control" name="password1" id="password1" placeholder="New Password" autocomplete="off">
  </div>

  <div class="form-group">
<input type="password" class="input-lg form-control" name="password2" id="password2" placeholder="Repeat Password" autocomplete="off">
  </div>
  <div class="form-group">
<input type="submit" class="col-xs-12 btn btn-primary btn-load btn-lg" data-loading-text="Changing Password..." value="Change Password">
  </div>

</form>
</div><!--/col-sm-6-->
</div><!--/row-->
</div>
</div>
  <!-- /.content-wrapper -->
  <?php require_once '../public/footer.php'; ?>
</div>
<!-- jQuery 3 -->
<?php require_once '../public/script.php'; ?>
</body>
</html>
<script type="text/javascript">
  $("input[type=password]").keyup(function(){
    var ucase = new RegExp("[A-Z]+");
  var lcase = new RegExp("[a-z]+");
  var num = new RegExp("[0-9]+");

  if($("#password1").val().length >= 8){
    $("#8char").removeClass("glyphicon-remove");
    $("#8char").addClass("glyphicon-ok");
    $("#8char").css("color","#00A41E");
  }else{
    $("#8char").removeClass("glyphicon-ok");
    $("#8char").addClass("glyphicon-remove");
    $("#8char").css("color","#FF0004");
  }

  if(ucase.test($("#password1").val())){
    $("#ucase").removeClass("glyphicon-remove");
    $("#ucase").addClass("glyphicon-ok");
    $("#ucase").css("color","#00A41E");
  }else{
    $("#ucase").removeClass("glyphicon-ok");
    $("#ucase").addClass("glyphicon-remove");
    $("#ucase").css("color","#FF0004");
  }

  if(lcase.test($("#password1").val())){
    $("#lcase").removeClass("glyphicon-remove");
    $("#lcase").addClass("glyphicon-ok");
    $("#lcase").css("color","#00A41E");
  }else{
    $("#lcase").removeClass("glyphicon-ok");
    $("#lcase").addClass("glyphicon-remove");
    $("#lcase").css("color","#FF0004");
  }

  if(num.test($("#password1").val())){
    $("#num").removeClass("glyphicon-remove");
    $("#num").addClass("glyphicon-ok");
    $("#num").css("color","#00A41E");
  }else{
    $("#num").removeClass("glyphicon-ok");
    $("#num").addClass("glyphicon-remove");
    $("#num").css("color","#FF0004");
  }

  if($("#password1").val() == $("#password2").val()){
    $("#pwmatch").removeClass("glyphicon-remove");
    $("#pwmatch").addClass("glyphicon-ok");
    $("#pwmatch").css("color","#00A41E");
  }else{
    $("#pwmatch").removeClass("glyphicon-ok");
    $("#pwmatch").addClass("glyphicon-remove");
    $("#pwmatch").css("color","#FF0004");
  }
});
</script>
