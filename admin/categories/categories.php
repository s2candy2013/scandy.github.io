<?php
session_start();
require_once '../public/db.php';
if (!isset($_SESSION['save_session'])) {
  header("location:../dangnhap.php");
}
$query = "select * from categories";
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
        Danh mục sản phẩm
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="col-md-1"></div>
	        <div class="col-md-10">
	        	<table class="table table-bordered table-striped table-reponsive">
				 	<tr>
				 		<th>Name</th>
				 		<th style="width: 50%">Short_desc</th>
				 		<th colspan="2" style="width: 50px; text-align: center;"><a href="add_categories.php"><i class="fa fa-plus-square"></i></a></th>
            <th width="40%">Chi tiết</th>
				 	</tr>
				 	<?php foreach ($listPro as $lPro): ?>
				 		<tr>
					 		<td><?=$lPro['name']?></td>
					 		<td><?=$lPro['short_desc']?></td>
					 		<td style="text-align: center;"><a href="update_categories.php?id=<?=$lPro['id']?>"><i class="fa fa-edit"></i></a></td>
              <td>
                <a onclick="xoa('remove_categories.php?id=<?=$lPro['id']?>')">
                  <i class="fa fa-trash"></i></a>
              </td>
					 		<td style="text-align: center;"><a href="categories_detail.php?id=<?=$lPro['id']?>"><i class="fa fa-info-circle"></i></a></td>
				 		</tr>
				 	<?php endforeach ?>
				 </table>
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
   <script type="text/javascript">
   function xoa(url) {
     var conf = confirm("Bạn có muốn xóa sản phẩm này?");
        if (conf) {
    window.location = url;
   }
   }
 </script>
</body>
</html>
