<?php
require_once '../dangnhap/db.php';
$name = $_POST['name'];
$phone_number = $_POST['phone_number'];
$email = $_POST['email'];
$content = $_POST['content'];


$saveContactQuery = "insert into contact_form
(name,phone_number,email,content)
values
('$name','$phone_number','$email','$content')
";
run($saveContactQuery,false);

header("location:../contact.php");
 ?>
