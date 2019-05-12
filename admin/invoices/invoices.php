<?php
session_start();
require_once '../public/db.php';
if (!isset($_SESSION['save_session'])) {
  header("location:../dangnhap.php");
}
$query = "select users.`name` as Uname, users.avatar as Uavatar, invoices.id, invoices.total_price, invoices.created_at from users join invoices on users.id = invoices.user_id";
$row = executeQuery("select count(id) as total from ($query) as ab");
  $total_records = $row['total'];
  $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
  $limit = isset($_GET['limit']) ? $_GET['limit'] : 5;
  $total_page = ceil($total_records / $limit);
  if ($current_page > $total_page){
    $current_page = $total_page;
  }
  else if ($current_page < 1){
    $current_page = 1;
  }
  $start = ($current_page - 1) * $limit;
  $query.= " LIMIT $start, $limit";
  $list_invoice = executeQuery($query,true);
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
    .table_invoices{
      margin: 20px 0;
      background-color: white;
      text-align: center;
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
        Danh sách hóa đơn
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
	        <div class="col-md-12">
          <?php foreach ($list_invoice as $invoice): ?>
	        	<table class="table_invoices table table-bordered table-reponsive">
            <?php
              $count = 0;
              $id_invoice = $invoice['id'];
              $query_invoice_detail = "select * from invoice_detail where invoice_id = '$id_invoice'";
              $invoice_detail = executeQuery($query_invoice_detail,true);
             ?>
				 		<tr>
              <td style="text-align: left;padding-left: 20px; " colspan="4"><img src="<?=$invoice['Uavatar']?>" class="img-circle" alt="avatar" width ="50px">  <?=$invoice['Uname']?></td>
					 		<td>Mã hóa đơn: #<?=$invoice['id']?></td>
				 		</tr>
             <tr>
               <td>Ảnh</td>
               <td>Giá</td>
               <td>Số lượng</td>
               <td>Tổng</td>
               <td>Thao tác</td>
             </tr>
            <?php foreach ($invoice_detail as $data_invoice_detail): ?>

                <tr>
                  <td><img src="<?=$data_invoice_detail['image']?>" alt="" width ="70px"></td>
                  <td><?=$data_invoice_detail['sell_price'] ?>$</td>
                  <td>X <?=$data_invoice_detail['quantity'] ?></td>
                  <td><?=$data_invoice_detail['total_price'] ?>$</td>
                  <?php if ($count==0): ?>
                    <td rowspan="<?=count($invoice_detail)?>" style="text-align: center;"><a href="invoice_detail.php?id=<?=$invoice['id']?>" style="padding-top: 50%;">Chi tiết</a></td>
                    <?php $count++ ?>
                  <?php endif ?>
                </tr>
            <?php endforeach ?>
                  <tr>
                    <td colspan="5" style="text-align: right;padding-right: 50px;">Tổng giá trị: <?=$invoice['total_price']?></td>
                  </tr>
				 </table>
          <?php endforeach ?>
          <div class="phantrang">
                <?php if ($current_page > 1 && $total_page > 1): ?>
                  <a href="invoices.php?page=<?=$current_page-1?>">Prev</a> |
                <?php endif ?>
                <?php for ($i = 1; $i <= $total_page; $i++):?>
                <?php if ($i == $current_page): ?>
                  <span><?=$i?></span>|
                <?php else: ?>
                  <a href="invoices.php?page=<?=$i?>"><?=$i?></a> |
                <?php endif ?>
                <?php endfor ?>
                <?php if ($current_page < $total_page && $total_page > 1): ?>
                  <a href="invoices.php?page=<?=$current_page+1?>">Next</a>
                <?php endif ?></div>
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
