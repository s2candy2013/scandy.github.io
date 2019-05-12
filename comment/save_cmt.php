<?php
require_once '../dangnhap/db.php';
session_start();
$errname = "";
$errcontent = "";
if ($_POST['name']!="") {
  $name= $_POST['name'];
}else{
  $errname = 'not null';
}
if ($_POST['content']!="") {
  $content = $_POST['content'];
}else{
  $errcontent = 'not null';
}
if ($errcontent.$errname!="") {
  header("location:../product-detail.php?errname=$errname&&errcontent=$errcontent");die;
}
// $_SESSION['save_session']['id'] = 1;
$star = $_POST['star'];
$pro_id = $_POST['pro_id'];
$user_id = $_SESSION['save_session']['id'];
$date = $_POST['date_cmt'];
// echo $_POST['content'],$errcontent;
if ($_SESSION['save_session']['role']<3) {
  $sql_comment = "insert into comments (pro_id,content,star,user_id,status,created_at) value ('$pro_id','$content','$star','$user_id','1','$date')";
} else {
  $sql_comment = "insert into comments (pro_id,content,star,user_id,status,created_at) value ('$pro_id','$content','$star','$user_id','0','$date')";
}

// var_dump($sql_comment);die;
run($sql_comment);
header("location:../product-detail.php?id=$pro_id");die;
 ?>
