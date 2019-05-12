<?php 
session_start();
unset($_SESSION['save_session']);
unset($_SESSION['cart']);
header("location:../index.php");
 ?>