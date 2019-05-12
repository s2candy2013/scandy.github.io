<?php
session_start();
require_once '../public/verify.php';
require_once '../public/db.php';
$id = $_GET['id'];
$de_com = "select comments.id, comments.pro_id, comments.content, comments.star, comments.created_at, comments.updated_at, comments.user_id, users.name as 'ten'
 from comments inner join users on comments.user_id=users.id where comments.id=$id";
$de_comQuery = executeQuery($de_com);
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
        Chi tiết Bình luận
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
              <h3 class="box-title">Chi tiết bình luận</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="post" action="save_update.php" enctype="multipart/form-data">
              <input type="hidden" name="id" value="<?=$id?>">
              <div class="box-body">
                <div class="form-group">
                  <label for="name">Mã sản phẩm chứa bình luận</label>
                  <input type="text" disabled class="form-control" id="name" placeholder="Nhập tên sản phẩm" name="pro_id" value="<?=$de_comQuery['pro_id']?>">
                </div>
                <!-- <div class="form-group">
                  <label for="image">Ảnh sản phẩm</label>
                  <img src="<?=$data_pro['image']?>" alt="product" width="100px">
                  <input type="file" id="image" name="image">
                </div> -->
                <div class="form-group">
                  <label for="content">Nội dung bình luận</label>
                  <textarea type="text" name="content" disabled class="form-control" id="content">
                      <?=$de_comQuery['content']?>
                  </textarea>
                </div>
                <div class="form-group">
                  <label for="star">Số sao</label>
                  <input type="text" disabled class="form-control" id="star" placeholder="Nhập tên sản phẩm" name="star" value="<?=$de_comQuery['star']?>">
                </div>
                <div class="form-group">
                  <label for="created">Ngày tạo</label>
                  <input type="text" disabled class="form-control" id="ori_price" name="created" value="<?=str_replace(" ", "/",$de_comQuery['created_at']);
                    ?>">
                </div>
                <div class="form-group">
                  <label for="created">Ngày chỉnh sửa lần cuối</label>
                  <input type="text" disabled class="form-control" id="ori_price" name="updated" value="<?=str_replace(" ", "/",$de_comQuery['updated_at']);
                    ?>">
                </div>
                <label>Tên người dùng bình luận</label>
              <div class="form-group">
                  <div class="col col-lg-3">
                    <input type="hidden" name="user_id" value="<?=$de_comQuery['user_id']?>">
                  <input type="text" disabled class="form-control" name="user_comment" value="<?=$de_comQuery['ten']?>">
                </div>
                  <div class="col col-lg-2">
                    <a href="../user/phanquyen.php?id=<?= $de_comQuery['user_id'] ?>">
                     <span class="glyphicon glyphicon-search"></span>
                    </a>
                  </div>
                </div>
              </div>
              <!-- /.box-body -->
              <br>
              <div class="box-footer">
                <a class="btn btn-primary" href="comments.php">
                     Quay lại trang quản lý bình luận
                </a>
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

