<?php
session_start();
require_once '../public/verify.php';
require_once '../public/db.php';
$settingUpdate = "select * from settings";
$settingUpdateQuery = executeQuery($settingUpdate);
$email = $_POST['email'];
$address = $_POST['address'];
$hotline = $_POST['hotline'];
$maps = $_POST['maps'];
$phone_number = $_POST['phone_number'];
$logo = $_FILES['logo_url'];
$logo_url = $settingUpdateQuery['logo_url'];
// kiểm tra xem file ảnh đó có trông hay không
if($logo['size'] > 0){
    $logo_url = '../../upload/logo/' . uniqid() . '-' . $logo['name'];
    move_uploaded_file($logo['tmp_name'], $logo_url);
    $logo_url = str_replace("../../","/","$logo_url");
    // $logo = $logo_url;
  }

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $settingErr = "Định dạng email không đúng";
}
if ($address=="") {
  $settingErr = "Không được để trống địa chỉ cửa hàng. Vui lòng nhập lại";
}
$regex = '/<iframe\s*src="https:\/\/www\.google\.com\/maps\/embed\?[^"]+"*\s*[^>]+>*<\/iframe>/';
if (!preg_match($regex, $maps)) {
            $settingErr = "Sai địa chỉ map. Vui lòng nhập lại";
}
$regex_number = '/^(01[2689]|09)[0-9]{8}$/';
if (!preg_match($regex_number, $phone_number)) {
            $settingErr = "Sai định dạng số điện thoại. Vui lòng nhập lại";
}
if (!preg_match($regex_number, $hotline)) {
            $settingErr = "Sai định dạng số điện thoại hotline. Vui lòng nhập lại";
}
if ($_FILES['logo_url']==0) {
  $settingErr = "Vui lòng chọn logo cho trang web";
}
if($settingErr!= ""){
 header("location: websetting.php?settingErr=$settingErr");die;
}
$email=getConnect()->quote($email);
$address=getConnect()->quote($address);
$maps=getConnect()->quote($maps);
  $saveSetting = "update settings
        set
            `email` = $email,
            `address` = $address,
            hotline = '$hotline',
            `maps` = $maps,
            phone_number = '$phone_number',
            `logo_url` = '$logo_url'
                  ";
  $saveSettingQuery = executeQuery($saveSetting);
header('location: websetting.php');
 ?>
