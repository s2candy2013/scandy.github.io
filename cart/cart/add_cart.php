<?php 
session_start();
require_once '../dangnhap/db.php';
// lấy id sản phẩm để truy vấn
$id = $_GET['id'];
$unit_url = $_SESSION['unit_url'];
// var_dump($_SESSION['unit_url']);die;


// tạo câu lệnh truy vấn trong database
$sql_product ="select * from products where id='$id'";

// tạo biến để lưu thông tin sản phẩm
$product = run($sql_product);

// tạo mảng để lưu giỏ hàng
if (isset($_SESSION['cart'][$id])) {
	$_SESSION['cart'][$id]['quantity']++;
	$quantity = $_SESSION['cart'][$id]['quantity'];
	$_SESSION['cart'][$id]['total'] = $quantity * $product['sell_price'];
	header("location: $unit_url");die;
}else{
	$_SESSION['cart'][$id]['image'] = $product['image'];
	$_SESSION['cart'][$id]['name'] = $product['name'];
	$_SESSION['cart'][$id]['short_desc'] = $product['short_desc'];
	$_SESSION['cart'][$id]['quantity'] = 1;
	$_SESSION['cart'][$id]['sell_price'] = $product['sell_price'];
	$_SESSION['cart'][$id]['total'] = $_SESSION['cart'][$id]['quantity']*$product['sell_price'];
	header("location: $unit_url");die;
}
 ?>