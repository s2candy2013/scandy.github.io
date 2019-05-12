<?php
session_start();
// kết nối đến database
require_once 'dangnhap/db.php';
// lấy id từ session
// session do file checklogin tạo
$id = $_SESSION['save_session']['id'];
// var_dump($id);die;
// tạo câu lệnh truy vấn trong db lấy ra thông tin  người dùng có id bằng với cái id của session
$query_user = "select * from users where id = $id";
// tạo biến để lưu thông tin người dùng
$data_user = run($query_user);
// var_dump($data_user);die;
// lấy dữ liệu từ file my-account.php gửi sang
$name = $_POST['name'];
// $email = $_POST['email'];
$age = $_POST['age'];
$sex = $_POST['sex'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$avatar = $_FILES['avatar'];
// kiểm tra xem người dùng có chọn file ảnh đại diện mới không
if ($avatar['size'] <= 0) {
	$avatar = $data_user['avatar'];
}
// kiểm tra file avatar người dùng gửi lên có phải file ảnh không
if ($avatar['size'] > 0) {
	$allowed = ['gif', 'png', 'jpg', 'jpeg'];
	$nametpm = $avatar['name'];
	$eavatar ="";
	$ext = pathinfo($nametpm, PATHINFO_EXTENSION);
	if (!in_array($ext, $allowed)) {
		$eavatar = "Please select the correct image format (gif, png, jpg, jpeg)";
	}
}
// nếu khong đúng định dạng ảnh thì quay lại my-account.php và hiển thị lỗi
if ($eavatar != '') {
	header("location:my-account.php?eavatar=$eavatar");die;
}
// thực hiện lưu file lên sever
if ($avatar['size'] > 0) {
	$saveurl = 'upload/user/' . uniqid() . '-' . $avatar['name'];
	move_uploaded_file($avatar['tmp_name'], $saveurl);
	$avatar = "/".$saveurl;
}
// tạo câu lệnh update user
$query_update_user = "update users
								 set
								 	name = '$name',
								 	avatar = '$avatar',
								 	age = '$age',
								 	address = '$address',
								 	sex = '$sex',
								 	phone = '$phone'
								 where
								 	id = $id";
// thực thi câu lệnh
// var_dump($query_update_user);die;
run($query_update_user);
// cập nhật lại session
$_SESSION['save_session'] = run($query_user);
// update thành công quay lại trang mai ơ cao chấm pê hát pê
header("location:my-account.php");die;
 ?>
