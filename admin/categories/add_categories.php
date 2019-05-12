<?php
session_start();
require_once '../public/db.php';
$querycate = "select * from categories";
$data_cate = executeQuery($querycate,true);
if (!isset($_SESSION['save_session'])) {
  header("location:../dangnhap.php");
}
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
        Thêm danh mục
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
	        <div class="col-md-12">
	        	          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Thêm danh mục</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="save_add.php" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Tên danh mục</label>
                  <input type="text" class="form-control" id="name" placeholder="Nhập tên danh mục" name="name">
                  <span style="color: red;"><?=$_GET['ename']?></span>
                </div>
                <div class="form-group">
                  <label for="short_desc">Mô tả ngắn</label>
                  <input type="text" class="form-control" id="short_desc" placeholder="Mô tả ngắn" name="short_desc">
                  <span style="color: red;"><?=$_GET['eshort']?></span>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Thêm danh mục</button>
              </div>
            </form>
          </div>
	        </div>
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
