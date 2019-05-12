<?php
require_once '../public/db.php';
$status = $_POST['status'];
$id = $_POST['id'];
$query_save_update_invoice = "update invoices
								set
									status = '$status'
								where id = '$id'";
executeQuery($query_save_update_invoice);
header("location:invoice_detail.php?id=$id");
 ?>
