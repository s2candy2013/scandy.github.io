<?php
session_start();
require_once '../public/style.php';
require_once '../public/db.php';
// if (!isset($_SESSION['save_session'])) {
//   header("location:../dangnhap.php");
// }
$id = $_GET['id'];
$sqlQuery = "delete from comments where id = $id";
executeQuery($sqlQuery);
header('location: comments.php');

 ?>
