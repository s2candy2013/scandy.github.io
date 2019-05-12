<?php 
session_start();
$id=$_GET['id'];
$cart = $_SESSION['cart'];
unset($cart[$id]);
$_SESSION['cart'] = $cart;
header('location: ../shopping-cart.php');die;
?>