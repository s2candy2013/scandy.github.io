<?php 
session_start();
unset($_SESSION['save_session']);
header("location:signin.php");
 ?>