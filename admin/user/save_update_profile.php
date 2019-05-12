<?php
session_start();
require_once '../public/verify.php';
require_once '../public/db.php';
$id_user = $_SESSION['save_session']['id'];
// $id_userQuery = executeQuery($id_user);
$email = $_POST['email'];
$address = $_POST['address'];
$name = $_POST['name'];
$age = $_POST['age'];
$gender = $_POST['sex'];
$avatar = $_FILES['avatar_url'];
/*$avatar_url = $_SESSION['save_session']['avatar'];*/
$sqlQuery = "select * from users";
$users = executeQuery($sqlQuery, false);
$fileName = $users['avatar'];



// kiểm tra xem file ảnh đó có trông hay không

  if($avatar['size'] > 0){
    $fileName = '../../upload/user/' . uniqid() . '-' . $avatar['name'];
    move_uploaded_file($avatar['tmp_name'], $fileName);
    $fileName = str_replace("../../","/","$fileName");
    // $avatar = $fileName;
  }
  $prErr='';
  if ($name=='') {
    $prErr = "Tên không được để trống. Vui lòng nhập lại";
  }
  if ($address=='') {
    $prErr = "Tên không được để trống. Vui lòng nhập lại";
  }
  if ($age<18||$age>100) {
    $prErr = "Tuổi chỉ được phép lớn hơn 18 và nhỏ hơn 100. Vui lòng nhập lại";
  }
  if ($age=='') {
    $prErr = "Tuổi không được phép để trống. Vui lòng nhập lại";
  }
  if ($_FILES['avatar_url']=='') {
   $prErr = "Ảnh đại diện không được để trống. Vui lòng chọn lại";
  }
  if ($prErr!='') {
    header("location: update_profile.php?prErr=$prErr");die;
  }
  $saveProfile = "update users
        set
            `email` = '$email',
            `address` = '$address',
            `name` = '$name',
            age = '$age',
            sex = '$gender',
          `avatar` = '$fileName' where id = $id_user
                  ";
  executeQuery($saveProfile);
  $_SESSION['save_session']['email'] = $email;
  $_SESSION['save_session']['address'] = $address;
  $_SESSION['save_session']['sex'] = $gender;
  $_SESSION['save_session']['age'] = $age;
  $_SESSION['save_session']['name'] = $name;
  $_SESSION['save_session']['avatar'] = $fileName;
  header("location: profile.php");
 ?>
