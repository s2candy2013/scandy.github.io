<?php
require_once '../public/db.php';
session_start();
if (!isset($_SESSION['save_session'])) {
  header("location:../dangnhap.php");
}
$id = $_GET['id'];
$queryInvoices = "update invoice_detail set pro_id = NULL where pro_id = '$id'";
executeQuery($queryInvoices);
$query = "delete from products where id = '$id'";
executeQuery($query);
header("location:products.php");
 ?>
