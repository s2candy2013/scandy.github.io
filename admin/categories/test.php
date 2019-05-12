<?php
if (!isset($_SESSION['save_session'])) {
  header("location:../dangnhap.php");
}
$m = array('a'=>'1', 'b'=>'2', 'c'=>'3', 'd'=>'4');
echo array_shift($m);
 ?>
