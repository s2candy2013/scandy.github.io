<?php
require_once '../public/db.php';
session_start();
if (!isset($_SESSION['save_session'])) {
  header("location:../dangnhap.php");
}
$id=$_POST['id'];
$role=$_POST['role'];
$query = "select * from users where id='$id'";
$run = executeQuery($query);
if (!isset($_POST['role'])) {
	$role = $run['role'];
}
$update = "update users set role='$role' where id = '$id'";
executeQuery($update);
header("location:danhsachUser.php?id=$id");
 ?>
