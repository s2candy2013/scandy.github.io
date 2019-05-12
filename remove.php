<?php 

$id = $_GET['id'];

// tao ket noi den csdl
$conn = new PDO("mysql:host=sql113.byethost.com;dbname=b7_23270826_testsofa;charset=utf8","b7_23270826","2951999");

$sqlQuery = "delete from post where id = $id";

// nap cau sql vao trong ket noi
$stmt = $conn->prepare($sqlQuery);

// thuc thi cau lenh sql voi csdl
$stmt->execute();

header('location: index.php');

 ?>