<?php
session_start();
require_once '../public/verify.php';
require_once '../public/db.php';
$id = isset($_GET['id'])?$_GET['id']:1;
$query_invoice_user = "select users.`name` as Uname, users.email, users.phone, users.address, invoices.id, invoices.total_price, invoices.status, invoices.created_at from users join invoices on users.id = invoices.user_id where invoices.id = '$id'";
$data_invoice_user = executeQuery($query_invoice_user);
$query_invoice_detail = "select * from invoice_detail where invoice_id = '$id'";
$data_invoice_detail = executeQuery($query_invoice_detail,true);
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
    .invoice-box {
        max-width: 800px;
        margin: auto;
        padding: 30px;
        border: 1px solid #eee;
        box-shadow: 0 0 10px rgba(0, 0, 0, .15);
        font-size: 16px;
        line-height: 24px;
        font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        color: #555;
        background-color: white;
    }

    .invoice-box table {
        width: 100%;
        line-height: inherit;
        text-align: left;
    }

    .invoice-box table td {
        padding: 5px;
        vertical-align: top;
    }

    .invoice-box table tr td:nth-child(2) {
        text-align: right;
    }

    .invoice-box table tr.top table td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.top table td.title {
        font-size: 45px;
        line-height: 45px;
        color: #333;
    }

    .invoice-box table tr.information table td {
        padding-bottom: 40px;
    }

    .invoice-box table tr.heading td {
        background: #eee;
        border-bottom: 1px solid #ddd;
        font-weight: bold;
    }

    .invoice-box table tr.details td {
        padding-bottom: 20px;
    }

    .invoice-box table tr.item td{
        border-bottom: 1px solid #eee;
    }

    .invoice-box table tr.item.last td {
        border-bottom: none;
    }

    .invoice-box table tr.total td:nth-child(2) {
        border-top: 2px solid #eee;
        font-weight: bold;
    }

    @media only screen and (max-width: 600px) {
        .invoice-box table tr.top table td {
            width: 100%;
            display: block;
            text-align: center;
        }

        .invoice-box table tr.information table td {
            width: 100%;
            display: block;
            text-align: center;
        }
    }

    /** RTL **/
    .rtl {
        direction: rtl;
        font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    }

    .rtl table {
        text-align: right;
    }

    .rtl table tr td:nth-child(2) {
        text-align: left;
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
        Chi tiết hóa đơn
      </h1>
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
	        <div class="col-md-12">
            <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="4">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="https://www.sparksuite.com/images/logo.png" style="width:100%; max-width:300px;">
                            </td>

                            <td>
                                Mã hóa đơn #: <?=$id?><br>
                                Thời gian tạo: <?=$data_invoice_user['created_at']?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="information">
                <td colspan="4">
                    <table>
                        <tr>
                            <td>
                                <?=$data_invoice_user['address']?><br>
                                <?=$data_invoice_user['phone']?>

                            </td>
                            <td>
                                <?=$data_invoice_user['Uname']?><br>
                                <?=$data_invoice_user['email']?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr class="heading">
                <td>
                    Phương thức thanh toán
                </td>
                <td></td>
                <td></td>
                <td>
                    Check #
                </td>
            </tr>

            <tr class="details">
                <td>
                    Check
                </td>
                <td></td>
                <td></td>
                <td>
                    1000
                </td>
            </tr>

            <tr class="heading">
                <td>
                    Sản phẩm
                </td>

                <td>
                    Giá
                </td>

                <td style="text-align: center;">
                    Số lượng
                </td>

                <td>
                    Tổng
                </td>
            </tr>
            <?php foreach ($data_invoice_detail as $invoice_detail): ?>
              <tr class="item">
                <td>
                    <?=$invoice_detail['name']?>
                </td>

                <td>
                    $<?=$invoice_detail['sell_price']?>
                </td>

                <td style="text-align: center;">
                    X<?=$invoice_detail['quantity']?>
                </td>

                <td>
                    $<?=$invoice_detail['total_price']?>
                </td>
            </tr>
            <?php endforeach ?>


            <tr class="total">
                <td>
                    <form action="save_update_invoice.php" method="post" >
                        <input type="hidden" name="id" value="<?=$id?>">
                        <select onchange="this.form.submit()" name="status" id="status" name="status" >
                        <option <?php if ($data_invoice_user['status'] =="Chờ xác nhận"): ?>
                            selected
                        <?php endif ?> value="Chờ xác nhận">Chờ xác nhận</option>
                        <option <?php if ($data_invoice_user['status'] =="Đã xác nhận"): ?>
                            selected
                        <?php endif ?> value="Đã xác nhận">Đã xác nhận</option>
                        <option <?php if ($data_invoice_user['status'] =="Hoàn thành"): ?>
                            selected
                        <?php endif ?> value="Hoàn thành">Hoàn thành</option>
                        <option <?php if ($data_invoice_user['status'] =="Đã hủy"): ?>
                            selected
                        <?php endif ?> value="Đã hủy">Đã hủy</option>
                      </select>
                </form>

                </td>
                <td></td>
                <td></td>

                <td>
                   $<?=$data_invoice_user['total_price']?>
                </td>
            </tr>

        </table>
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
