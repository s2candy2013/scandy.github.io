<?php
session_start();
require_once '../public/db.php';
if (!isset($_SESSION['save_session'])) {
  header("location:../dangnhap.php");
}
$query = "select * from products";
$row = executeQuery("select count(id) as total from ($query) as ab");
  $total_records = $row['total'];
  $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
  $limit = isset($_GET['limit']) ? $_GET['limit'] : 8;
  $total_page = ceil($total_records / $limit);
  if ($current_page > $total_page){
    $current_page = $total_page;
  }
  else if ($current_page < 1){
    $current_page = 1;
  }
  $start = ($current_page - 1) * $limit;
  $query.= " LIMIT $start, $limit";
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
    .phantrang{
      margin-top: 30px;
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
        Danh sách sản phẩm
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /.col -->
	        <div class="col-md-12">
	        	<table class="table-striped table-bordered">
				 	<tr>
				 		<th>Tên sản phẩm</th>
				 		<th>Ảnh sản phẩm</th>
            <th>Mô tả ngắn</th>
            <th>Lượt xem</th>
            <th>Đánh giá</th>
            <th>Giá cũ</th>
            <th>Giá mới</th>
            <th>Màu sắc</th>
            <th>Chất liệu</th>
				 		<th>Nhà sản xuất</th>
				 		<th colspan="2" width="50px"><a href="add_products.php"><i class="fa fa-plus-square"></i></a></th>
				 	</tr>
				 	<?php foreach ($listPro as $lPro): ?>
				 		<tr>
					 		<td><?=$lPro['name']?></td>
					 		<td><img width="70px" src="<?=$lPro['image']?>" alt="anhsp"></td>
              <td><?=$lPro['short_desc']?></td>
              <td><?=$lPro['views']?></td>
              <td><?=$lPro['star']?></td>
              <td><?=$lPro['ori_price']?></td>
              <td><?=$lPro['sell_price']?></td>
              <td><?=$lPro['color']?></td>
              <td><?=$lPro['material']?></td>
					 		<td><?=$lPro['manufacturer']?></td>
					 		<td><a href="update_products.php?id=<?=$lPro['id']?>"><i class="fa fa-edit"></i></a></td>
					 		<td>
                <a onclick="xoa('remove_products.php?id=<?=$lPro['id']?>')">
                  <i class="fa fa-trash"></i></a>
              </td>
				 		</tr>
				 	<?php endforeach ?>
				 </table>
         <div class="phantrang">
                <?php if ($current_page > 1 && $total_page > 1): ?>
                  <a href="products.php?page=<?=$current_page-1?>">Prev</a> |
                <?php endif ?>
                <?php for ($i = 1; $i <= $total_page; $i++):?>
                <?php if ($i == $current_page): ?>
                  <span><?=$i?></span>|
                <?php else: ?>
                  <a href="products.php?page=<?=$i?>"><?=$i?></a> |
                <?php endif ?>
                <?php endfor ?>
                <?php if ($current_page < $total_page && $total_page > 1): ?>
                  <a href="products.php?page=<?=$current_page+1?>">Next</a>
                <?php endif ?>
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
