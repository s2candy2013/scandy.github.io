<?php
session_start();
require_once '../public/db.php';
if (!isset($_SESSION['save_session'])) {
  header("location:../dangnhap.php");
}
$id = $_GET['id'];
$query = "select categories.`id` as cate_id, products.`id` as prod_id, products.`name`, products.views, products.star, products.`short_desc`, products.sell_price, products.size, products.`color`, products.`detail`, products.`image`, products.`manufacturer`, products.`material`, products.`name` FROM categories JOIN products on categories.`id` = products.`cate_id` WHERE categories.`id` = $id";

$listPro = executeQuery($query,true);
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
        Chi tiết danh mục
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /.col -->
          <div class="col-md-12">
            <table class="table table-bordered table-striped table-reponsive">
              <tr>
                <th>Id danh mục</th>
                <th>Id sản phẩm</th>
                <th>Tên sản phẩm</th>
                <th>Ảnh sản phẩm</th>
                <th>Miêu tả</th>
                <th>Lượt xem</th>
                <th>Đánh giá</th>
                <th>Giá mới</th>
                <th>Màu sắc</th>
                <th>Kích cỡ</th>
                <th>Nhà sản xuất</th>
                <th>Chất liệu</th>
                <th colspan="2"><a href="add_categories.php"><i class="fa fa-plus-square"></i></a></th>
              </tr>
              <?php foreach ($listPro as $lPro): ?>
                <tr>
                  <td><?=$lPro['cate_id']?></td>
                  <td><?=$lPro['prod_id']?></td>
                  <td><?=$lPro['name']?></td>
                  <td><img src="<?=$lPro['image']?>" alt="anhsp" width ="60px"></td>
                  <td><?=$lPro['short_desc']?></td>
                  <td><?=$lPro['views']?></td>
                  <td><?=$lPro['star']?></td>
                  <td><?=$lPro['sell_price']?></td>
                  <td><?=$lPro['color']?></td>
                  <td><?=$lPro['size']?></td>
                  <td><?=$lPro['manufacturer']?></td>
                  <td><?=$lPro['material']?></td>
                  <td><a href="update_categories.php?id=<?=$lPro['id']?>"><i class="fa fa-edit"></i></a></td>
                  <td><a href="remove_categories.php?id=<?=$lPro['id']?>"><i class="fa fa-trash"></i></a></td>
                </tr>
              <?php endforeach ?>
             </table>
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
