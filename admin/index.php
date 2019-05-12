<?php
session_start();
 require_once 'public/db.php';
 if (!isset($_SESSION['save_session'])) {
   header('location:dangnhap.php');die;
 }
 if ($_SESSION['save_session']['role']>=3) {
  session_destroy();
   header('location:dangnhap.php');die;
 }

 $userQuery = "select id from users as total";
 $categoryQuery = "select count(id) from categories";
 $invoiceQuery = "select * from invoices";
 $commentQuery = "select * from comments";
 $productQuery = "select id from products";
 $user = executeQuery($userQuery, true);
 $invoice = executeQuery($invoiceQuery, true);
 $comment = executeQuery($commentQuery, true);
 $product =  executeQuery($productQuery, true);
 $cate = executeQuery($categoryQuery, true);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <?php  require_once 'public/style.php'; ?>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php require_once 'public/header.php'; ?>
<div class="wrapper">
  <?php require_once 'public/sidebar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fa fa-dashboard"></i>
        Trang chủ
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= count($invoice)?></h3>

              <p>Hóa đơn</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="invoices/invoices.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= count($product)?></h3>

              <p>Sản phẩm</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="products/products.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= count($user)?></h3>

              <p>Người dùng</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="user/danhsachUser.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-6
         col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= count($comment)?></h3>

              <p>Comment</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="comment/comments.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require_once 'public/footer.php'; ?>
</div>
<!-- jQuery 3 -->
<?php require_once 'public/script.php'; ?>
</body>
</html>
