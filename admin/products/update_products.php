<?php
session_start();
require_once '../public/db.php';
if (!isset($_SESSION['save_session'])) {
  header("location:../dangnhap.php");
}
$id = $_GET['id'];
$querypro = "select * from products where id = '$id'";
$querycate = "select * from categories";
$data_cate = executeQuery($querycate,true);
$data_pro = executeQuery($querypro);
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
        Cập nhật sản phẩm
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
              <h3 class="box-title">Cập nhật sản phẩm</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="save_update.php" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?=$id?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Tên sản phẩm</label>
                  <input type="text" class="form-control" id="name" placeholder="Nhập tên sản phẩm" name="name" value="<?=$data_pro['name']?>">
                  <span style="color: red;"><?=$_GET['ename']?></span>
                </div>
                <div class="form-group">
                  <label for="image">Ảnh sản phẩm</label>
                  <img src="<?=$data_pro['image']?>" alt="product" width="100px">
                  <input type="file" id="image" name="image">
                  <input type="hidden" name="img_url" value="<?=$data_pro['image']?>">
                  <span style="color: red;"><?=$_GET['eimage']?></span>
                </div>
                <div class="form-group">
                  <label for="short_desc">Mô tả sản phẩm</label>
                  <input type="text" class="form-control" id="short_desc" placeholder="Mô tả ngắn" value="<?=$data_pro['short_desc']?>" name="short_desc">
                  <span style="color: red;"><?=$_GET['eshort']?></span>
                </div>
                <div class="form-group">
                  <label for="detail">Chi tiết sản phẩm</label>
                  <textarea class="form-control" id="detail" name="detail"><?=$data_pro['detail']?></textarea>
                  <span style="color: red;"><?=$_GET['edetail']?></span>
                </div>
                <div class="form-group">
                  <label for="ori_price">Giá sản phẩm</label>
                  <input type="number" class="form-control" id="ori_price" name="ori_price" value="<?=$data_pro['ori_price']?>">
                  <span style="color: red;"><?=$_GET['eori']?></span>
                </div>
                <div class="form-group">
                  <label for="sell_price">Giảm giá</label>
                  <input type="number" class="form-control" id="sell_price" name="sell_price" value="<?=$data_pro['sell_price']?>">
                  <span style="color: red;"><?=$_GET['esell']?></span>
                </div>
                <div class="form-group">
                  <label for="color">Màu sắc sản phẩm</label>
                  <input type="color" id="color" name="color" value="<?=$data_pro['color']?>">
                </div>
                <div class="form-group">
                  <label for="size">Kích cỡ</label>
                  <input type="text" class="form-control" id="size" name="size" value="<?=$data_pro['size']?>">
                  <span style="color: red;"><?=$_GET['esize']?></span>
                </div>
                <div class="form-group">
                  <label for="material">Chất liệu</label>
                  <input type="text" class="form-control" id="material" name="material" value="<?=$data_pro['material']?>">
                  <span style="color: red;"><?=$_GET['ematerial']?></span>
                </div>
                <div class="form-group">
                  <label for="manufacturer">Nhà sản xuất</label>
                  <input type="text" class="form-control" id="manufacturer" name="manufacturer" value="<?=$data_pro['manufacturer']?>">
                  <span style="color: red;"><?=$_GET['emanufacturer']?></span>
                </div>
                <div class="form-group">
                  <label>Danh mục sản phẩm</label>
                  <select class="form-control" name="cate_id">
                    <?php foreach ($data_cate as $key): ?>
                    	<option value="<?=$key['id']?>"><?=$key['name']?></option>
                    <?php endforeach ?>
                  </select>
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
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
