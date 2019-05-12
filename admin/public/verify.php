<?php
if (!isset($_SESSION['save_session'])) {
   header('location:http://afirebay.ml/admin/dangnhap.php');die;
}
if ($_SESSION['save_session']['role'] > 2) {
   header('location:http://afirebay.ml/index.php');die;
}
 ?>
