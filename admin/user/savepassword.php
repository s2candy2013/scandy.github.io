<?php
session_start();
require_once '../public/verify.php';
require_once '../public/db.php';
$id_user = $_SESSION['save_session']['id'];
$session_password = $_SESSION['save_session']['password'];
$password_old = $_POST['password_old'];
$password1 = $_POST['password1'];
$password2 = $_POST['password2'];
$hshPassword1 = password_hash($password1, PASSWORD_DEFAULT);
if (!password_verify($password_old,$session_password)) {
  $passwordErr = "Mật khẩu cũ không đúng. Vui lòng nhập lại";
}
if (strlen("$password1")<8) {
  $passwordErr = "Mật khẩu mới yêu cầu dài hơn 8 kí tự. Vui lòng nhập lại";
}
if ($password1 != $password2) {
  $passwordErr = "Mật khẩu xác nhận không đúng. Vui lòng nhập lại";
}
if($passwordErr!= ""){
 header("location: change_password.php?passwordErr=$passwordErr");die;
}
  $saveProfile = "update users
        set
            `password` = '$hshPassword1' where id = $id_user
                  ";
  $savepasswordQuery = executeQuery($saveProfile);
  header("location: profile.php");
  die;
 ?>
