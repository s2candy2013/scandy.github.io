 <?php
 session_start();
require_once '../public/verify.php';
require_once '../public/db.php';
// tao ket noi den db
$setting = "select * from settings";
$settingQuery = executeQuery($setting);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <style>
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color:#3F82CE ;
  color: white;
}
</style>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <?php require '../public/style.php'; ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php require_once '../public/header.php'; ?>
<div class="wrapper">
  <?php require_once '../public/sidebar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
<div class="row">
  <div class="col-xs-3"></div>
  <div class=" col-xs-6">
    <div class="card card-primary">
      <div class="card-header">
        <h3 class="card-title">Websettings</h3>
      </div>
      <!-- /.card-header -->
      <!-- form start -->
      <?php if (isset($_GET['settingErr'])):?>
  <span class="text-danger"><?= $_GET['settingErr'] ?></span>
  <?php else: ?>Enter the information website
<?php endif ?>
      <form action="setting.php" method="post" enctype="multipart/form-data">
        <div class="card-body">
          <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="email" value="<?= $settingQuery['email']; ?>" >
          </div>
          <div class="form-group">
            <label for="exampleInputAdress">Adress</label>
            <input type="text" class="form-control" id="exampleInputAdress" name="address" value="<?= $settingQuery['address']; ?>" >
          </div>
          <div class="form-group">
            <label for="exampleInputHotline">Hotline</label>
            <input type="text" class="form-control" id="exampleInputHotline" name="hotline" value="<?= $settingQuery['hotline']; ?>" >
          </div>
          <div class="form-group">
            <label for="exampleInputPhonenumber">Phone number</label>
            <input type="text" class="form-control" id="exampleInputPhonenumber" value="<?= $settingQuery['phone_number']; ?>" name="phone_number">
          </div>
          <div class="form-group">
            <label for="exampleInputMaps">Nhập mã nhúng địa chỉ map</label>
            <textarea name="maps" rows="10" class="form-control" id="exampleInputMaps"><?= $settingQuery['maps']; ?></textarea>
          </div>
          <div class="form-group">
            <div><?= $settingQuery['maps']; ?></div>
          </div>
          <div class="form-group">
            <label for="exampleInputFile">Logo</label>
            <div class="input-group">
              <div>
      <?php if (isset($settingQuery['logo_url'])): ?>
      <div style="width: 200px; border: 1px solid #ccc">
        <img src="<?= $settingQuery['logo_url'] ?>" style="width: 100%">
      </div>
      <?php endif ?>
    </div>
              <div class="custom-file">
                <input  accept="image/*" type="file" name="logo_url" class="custom-file-input" id="exampleInputFile">
                <label class="custom-file-label" for="exampleInputFile">Choose file</label>

                </div>
              </div>
              <div class="input-group-append">
                <span class="input-group-text" id="">Upload</span>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>



  </div>
  <!-- /.content-wrapper -->
  <?php require_once '../public/footer.php'; ?>
</div>
<!-- jQuery 3 -->
<?php
require_once '../public/script.php';
 ?>
</body>
</html>
