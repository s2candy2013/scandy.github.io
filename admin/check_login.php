<?php
session_start();
require_once 'public/db.php';
if (!isset($_SESSION['save_session'])) {
  header("location:dangnhap.php");
}
$email = $_POST['email'];
$psw = $_POST['psw'];
$query = "select * from users where email = '$email'";
$user = executeQuery($query);
if (!$user) {
  header("location:dangnhap.php?loi=sai email vui lòng nhập lại");die;
}
if (!password_verify($psw,$user['password'])) {
  header("location:dangnhap.php?loi=sai mật khẩu vui lòng nhập lại");die;
}
$_SESSION['save_session'] = $user;
if ($user['role'] < 3 ) {
  header("location:index.php");
}
else{
	session_destroy();
	header("location:dangnhap.php?loi= Bạn không có quyền truy cập trang này");
}
?>
