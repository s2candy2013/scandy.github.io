<?php
session_start();
require_once '../public/verify.php';
require_once '../public/db.php';

$image_url = $_FILES['image_url'];
$id = $_POST['id'];
$title = $_POST['title'];
$url = $_POST['url'];
$short_desc = $_POST['short_desc'];
$data = executeQuery("select * from sliders where id = $id");
if ($image_url['size'] <= 0) {
    $image_url = $data['image_url'];
  }
  $sliderErr='';
  // title không được để trống
  if ($title=='') {
    $sliderErr = "Không được để trống tiêu đề slide. Vui lòng nhập lại";
  }
// Kiểm tra xem có phải đường dẫn hợp lệ không
  if (filter_var($url, FILTER_FLAG_SCHEME_REQUIRED)) {
    $sliderErr = "Đường dẫn không hợp lệ. Vui lòng nhập lại";
}
// Kiểm tra shortdesc
$length_sdc = strlen($short_desc);
if ($length_sdc<8) {
  $sliderErr = "Mô tả ngắn không được nhỏ hơn 8 kí tự. Vui lòng chọn lại";
}
if ($_FILES['image_url']=='') {
  $sliderErr = "Ảnh slide không được để trống. Vui lòng chọn lại";
}
if ($image_url['size'] > 0) {
    $allowed =  ['gif','png' ,'jpg', 'jpeg'];
    $nametpm = $image_url['name'];
    $ext = pathinfo($nametpm, PATHINFO_EXTENSION);
    if(!in_array($ext,$allowed) ) {
      $sliderErr= "Vui lòng chọn đúng định dạng ảnh (gif, png, jpg, jpeg)";
    }
  }
if ($sliderErr !='') {
   header("location:update_slider.php?sliderErr=$sliderErr");die;
}
if($image_url['size'] > 0){
    $saveurl = '../../upload/slider/' . uniqid() . '-' . $image_url['name'];
    move_uploaded_file($image_url['tmp_name'], $saveurl);
    $image_url = str_replace("../../","/","$saveurl");
  }
  $query_update_sliders = "update sliders
        set
            `image_url` = '$image_url',
            `title` = '$title',
            `url` = '$url',
            `short_desc` = '$short_desc'
             where id = $id";
executeQuery($query_update_sliders);
  header("location:slider.php");
 ?>
