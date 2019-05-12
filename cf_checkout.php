<?php 
session_start();
require_once "dangnhap/db.php";
$_SESSION['UNIT_URL']=$_SERVER['REQUEST_URI'];
if ($_SESSION['save_session']['role']==1 || $_SESSION['save_session']['role']==2) {
        header('location:../index.php');
        die();
}

// require_once '../public/verify.php';
// require_once '../public/db.php';


    // include "PHPMailer-master/src/Exception.php";
    // include "PHPMailer-master/src/OAuth.php";
    // include "PHPMailer-master/src/PHPMailer.php";
    // include "PHPMailer-master/src/POP3.php";
    // include "PHPMailer-master/src/SMTP.php";

    // use PHPMailer\PHPMailer\PHPMailer;
    // use PHPMailer\PHPMailer\Exception;

    // $mail = new PHPMailer(true);

 ?>
 <?php 
    if (isset($_POST["btn-submit"])) {
    

    // lấy thông tin
    $name = $_POST['name'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $number = $_POST['number'];
    $user_id = $_SESSION['save_session']['id'];
    $cart = isset($_SESSION['cart'])? $_SESSION['cart']: [];

    $subtotal = 0;
    foreach ($cart as $value) {
        $subtotal+=$value['total'];
    }
    $total = $subtotal +100;
    // insert to invoices in db
    $query = "INSERT INTO invoices (name, email,address, phone_number, user_id, total_price) VALUES ('$name', '$email', '$address', '$number', '$user_id', '$total') ";


// var_dump($query);die;
    $conn= getConnect();
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $query = "SELECT id FROM invoices WHERE id=(SELECT max(id) FROM invoices)";
    $get_id = run($query);
    $invoices_id = $get_id['id'];
// insert to invoice_detail in db
foreach ($cart as $key=>$c) {

     $query = "INSERT INTO invoice_detail (invoice_id, quantity, total_price, name, image, short_desc, sell_price) VALUES (:invoice_id, :quantity, :total_price, :name, :image, :short_desc, :sell_price)";
    $conn= getConnect();
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':invoice_id', $invoices_id);
    $stmt->bindParam(':quantity', $c['quantity']);
    $stmt->bindParam(':total_price', $c['total']);
    $stmt->bindParam(':name', $c['name']);
    $stmt->bindParam(':image', $c['image']);
    $stmt->bindParam(':short_desc', $c['short_desc']);
    $stmt->bindParam(':sell_price', $c['sell_price']);
    $stmt->execute();


    }

                   

                     
  
     }
     else {
     	header("Location: index.php");die;
     }


                     $query = "SELECT id FROM invoices WHERE id=(SELECT max(id) FROM invoices)";
                     $get_id = run($query);
                     $invoices_id = $get_id['id'];
                     $query = "SELECT * FROM invoices WHERE id = $invoices_id";
                     $data_invoice_user = run($query);
                     $query = "SELECT * FROM c WHERE id = $invoices_id";
                     $data_c = run($query);
 ?>


<!doctype html>
<html class="no-js" lang="">
    
<!-- Mirrored from d29u17ylf1ylz9.cloudfront.net/cendo-preview/cendo/shopping-cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Mar 2019 08:45:00 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Sofa | Shopping-Cart</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php require_once 'public/style.php'; ?>
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
        <!-- modernizr JS
        ============================================ -->        
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        
        <?php require_once 'public/header.php'; ?>

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
                                <img src="/upload/logo/5cbf208facdaf-5cb6c49c03c90-54462673_163953891158921_5596081046517972992_n.jpg" style="width:100%; max-width:300px;">
                            </td>

                            <td>
                                Mã hóa đơn #: <?=$invoices_id?><br>
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
                                <?=$data_invoice_user['name']?><br>
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
                    COD
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
            <?php foreach ($cart as $key=>$c): ?>
              <tr class="item">
                <td>
                    <?=$c['name']?>
                </td>

                <td>
                    $<?=$c['sell_price']?>
                </td>

                <td style="text-align: center;">
                    X<?=$c['quantity']?>
                </td>

                <td>
                    $<?=$c['total']?>
                </td>
            </tr>
            <?php endforeach ?>

            <tr>
                <td>Shipping</td>
                <td></td>
                <td></td>
                <td>$100</td>
            </tr>
            <tr class="total">
                <td>Tổng tiền</td>
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

        <?php 
        unset($_SESSION['cart']); 
        require_once 'public/footer.php'; ?>
<!-- start scrollUp
============================================ -->
<div id="toTop">
<i class="fa fa-chevron-up"></i>
</div>
<!-- end scrollUp
============================================ -->
<!-- jquery
============================================ -->        
<?php require_once 'public/script.php'; ?>

</body>

<!-- Mirrored from d29u17ylf1ylz9.cloudfront.net/cendo-preview/cendo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Mar 2019 08:44:02 GMT -->
</html>