<?php
session_start();
require_once '../public/verify.php';
require_once '../public/db.php';
$id = $_GET['id'];
$sql = "delete from sliders where id=$id";
// var_dump($sql);die;
executeQuery($sql);
header("location: slider.php");die;
 ?>
