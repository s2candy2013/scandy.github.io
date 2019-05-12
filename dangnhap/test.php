<?php
session_start();
$user = $_SESSION['save_session'];
$password = $user['password'];

echo $password;

 ?>