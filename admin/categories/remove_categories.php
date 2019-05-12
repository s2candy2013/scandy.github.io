<?php
require_once '../public/db.php';
$id = $_GET['id'];
$delete_acagories = "delete from categories where id = '$id'";
executeQuery($delete_acagories);
header("location:categories.php");
 ?>