<?php
session_start();
require_once '../public/db.php';
if (!isset($_SESSION['save_session'])) {
  header("location:../dangnhap.php");
}
$id = isset($_GET['id'])?$_GET['id']:"";
$query = "select * from users where id =$id";
$user = executeQuery($query, false);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <?php
    require_once '../public/style.php';
   ?>
  <style type="text/css">
    .table td{
      width: 14%;
    }
  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php require_once '../public/header.php'; ?>
<div class="wrapper">
  <?php require_once '../public/sidebar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fa fa-dashboard"></i>
        Chi tiết tài khoản
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /.col -->
        <div class="col-md-2">

        </div>
        <div class="col-md-8">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active" ><a href="#settings" data-toggle="tab">Settings</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="settings">
                <form class="form-horizontal" action="updateUser.php" method="post">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Tên người dùng</label>

                    <div class="col-sm-10">
                      <input disabled type="text" class="form-control" id="inputName" placeholder="Name" value="<?=$user['name']?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                      <input disabled type="email" class="form-control" id="inputEmail" placeholder="Email" value="<?=$user['email']?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Địa chỉ</label>

                    <div class="col-sm-10">
                      <input disabled type="text" class="form-control" id="inputName" placeholder="Name" value="<?=$user['address']?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputExperience" class="col-sm-2 control-label">Giới tính</label>

                    <div class="col-sm-10">
                      <input disabled class="form-control" id="inputExperience" placeholder="Giới tính" value="<?=$user['sex']?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputSkills" class="col-sm-2 control-label">Phân quyền</label>

                    <div class="col-sm-10">
                      <select type="text" class="form-control" id="inputSkills" placeholder="Skills" name="role">
                      	<option <?php if ($user['role']==2): ?>
                      		selected
                      	<?php endif ?>value="1">Người quản trị</option>
                      	<option <?php if ($user['role']==3 || $user['role']==1): ?>
                      		selected
                      	<?php endif ?>value="2">Người quản lý</option>
                      	<option <?php if ($user['role']==2): ?>
                      		selected
                      	<?php endif ?> value="3">Người dùng thường</option>
                        <option <?php if ($user['role']==2 || $user['role']==3): ?>
                          selected
                        <?php endif ?> value="4">Khóa tài khoản</option>
                      </select>
                    </div>
                  </div>
                  <input type="hidden" name="id" value="<?=$user['id']?>">
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-danger">Cập nhật thông tin</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
    </section>
    <!-- /.content -->
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
