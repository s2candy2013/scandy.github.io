<?php 
session_start();
require_once '../dangnhap/db.php';
// lấy id sản phẩm để truy vấn
$id = $_GET['id'];
$type = $_GET['type'];

// tạo câu lệnh truy vấn trong database
$sql_product ="select * from products where id='$id'";

// tạo biến để lưu thông tin sản phẩm
$product = run($sql_product);

// tạo mảng để lưu giỏ hàng
if ($type=='giam' && $_SESSION['cart'][$id]['quantity']<=1) {
	header("location: ../shopping-cart.php");die;
}
if ($type =='tang') {
	$_SESSION['cart'][$id]['quantity']++;
	$quantity = $_SESSION['cart'][$id]['quantity'];
	$_SESSION['cart'][$id]['total'] = $quantity * $product['sell_price'];
	header('location: ../shopping-cart.php');die;
}
if ($type=='giam') {
	$_SESSION['cart'][$id]['quantity']--;
	$quantity = $_SESSION['cart'][$id]['quantity'];
	$_SESSION['cart'][$id]['total'] = $quantity * $product['sell_price'];
	header('location: ../shopping-cart.php');die;
	
}
header('location: ../shopping-cart.php');die;

?>