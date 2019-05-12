<?php
require_once '../public/db.php';
if (!isset($_SESSION['save_session'])) {
  header("location:../dangnhap.php");
}
$id = $_GET['id'];
$sqlQuery = "delete from contact_form where id = $id";
executeQuery($sqlQuery);
header('location: contact.php');

 ?>
