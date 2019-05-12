<?php
session_start();
require_once '../public/db.php';
if (!isset($_SESSION['save_session'])) {
  header("location:../dangnhap.php");
}
$id = $_POST['id'];
$name = $_POST['name'];
$cate_id = $_POST['cate_id'];
$image = $_FILES['image'];
$short_desc = $_POST['short_desc'];
$detail = $_POST['detail'];
$ori_price = $_POST['ori_price'];
$sell_price = $_POST['sell_price'];
$color = $_POST['color'];
$size = $_POST['size'];
$material = $_POST['material'];
$manufacturer = $_POST['manufacturer'];
if ($image['size'] > 0) {
	$imageurl = "../../upload/products/". uniqid() . '-' . $image['name'];
	move_uploaded_file($image['tmp_name'], $imageurl);
  $imageurl = str_replace("../../","/","$imageurl");
}
else{
  $imageurl = $_POST['img_url'];
}
// validate
if ($_FILES['image']['size'] == 0) {
  $eimage = "Vui lòng chọn ảnh sản phẩm";
}
if ($sell_price =="") {
  $sell_price = $ori_price;
}
$ename = "";
if ($name == "") {
  $ename = "Tên sản phẩm không được để trống";
}
$eshort = "";
if ($short_desc == "") {
  $eshort = "Vui lòng nhập mô tả cho sản phẩm";
}
$edetail = "";
if ($detail =="") {
  $edetail = "Vui lòng nhập mô tả chi tiết sản phẩm";
}
$eori = "";
if ($ori_price =="") {
  $eori = "Vui lòng nhập giá cho sản phẩm";
}
$esell = "";
if ($sell_price > $ori_price) {
  $esell = "Giá mới của sản phẩm phải nhỏ hơn giá gốc";
}
$esize = "";
if ($size =="") {
  $esize = "Vui lòng nhập kích cỡ của sản phẩm";
}
$ematerial = "";
if ($material =="") {
  $ematerial = "Vui lòng chất liệu của sản phẩm";
}
$emanufacturer = "";
if ($manufacturer =="") {
  $emanufacturer = "Vui lòng nhập nhà sản xuất";
}
if ($ename.$eimage.$eshort.$edetail.$eori.$esell.$esize.$ematerial.$emanufacturer != "") {
  header("location:add_products.php?ename=$ename&&eimage=$eimage&&eshort=$eshort&&edetail=$edetail&&eori=$eori&&esell=$esell&&ematerial=$ematerial&&emanufacturer=$emanufacturer&&esize=$esize");die;
};
// kết thúc validate
$query = "update products set
    `name` ='$name',
    cate_id = '$cate_id',
    `image` ='$imageurl',
    `short_desc` ='$short_desc',
    `detail` ='$detail',
    ori_price ='$ori_price',
    `sell_price` ='$sell_price',
    `color` ='$color',
    size ='$size',
    material ='$material',
    manufacturer ='$manufacturer'
  where id = $id";
 executeQuery($query);
 header("location:products.php");
 ?>
