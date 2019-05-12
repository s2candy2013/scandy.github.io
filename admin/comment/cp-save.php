<?php
session_start();
require_once '../public/verify.php';
require_once '../public/db.php';
$id = $_POST['id'];
$status = isset($_POST['status'])? $_POST['status'] : 0;
$update_status_comment = "update comments set status = '$status' where id = $id ";
executeQuery($update_status_comment);
header("location: comments.php");
 ?>
