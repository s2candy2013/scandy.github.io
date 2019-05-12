<?php
session_start();
require_once 'db.php';
$email = $_POST['email'];
$psw = $_POST['psw'];


$query = "select * from users where email = '$email'";
$user = run($query);
if (!$user) {
	header("location:signin.php?loi=Sai email vui lòng nhập lại");die;
}
if (!password_verify($psw,$user['password'])) {
	header("location:signin.php?loi=Sai mật khẩu vui lòng nhập lại");die;
}
$query1 = "SELECT * FROM users WHERE email = ? and verified = 0";
$conn = getConnect();
$stmt = $conn->prepare( $query1 );
$stmt->bindParam(1, $email);
$stmt->execute();
$num = $stmt->rowCount();
if($num>0){
	header("location:signin.php?loi= Tài khoản của bạn chưa xác nhận email!");die;
}
$query2 = "SELECT * FROM users WHERE email = ? and role = 4";
$conn = getConnect();
$stmt = $conn->prepare( $query2 );
$stmt->bindParam(1, $email);
$stmt->execute();
$num2 = $stmt->rowCount();
if($num2>0){
	header("location:signin.php?loi= Tài khoản của bạn đã bị khóa!");die;
}
$_SESSION['save_session'] = $user;
if ($user['role'] == 3 ) {
	header("location:http://afirebay.ml/index.php");
}
else {
	header("location:http://afirebay.ml/admin/index.php");
}
// header("location:../index.php");
?>
