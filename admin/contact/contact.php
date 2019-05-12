
 <?php
session_start();
// tao ket noi den db
require_once '../public/verify.php';
require_once '../public/db.php';
if (!isset($_SESSION['save_session'])) {
  header("location:../dangnhap.php");
}
$tongsotin1trang = 6; // tự đặt
// ép kiểu và gán mặc định cho số trang đang xem
if (isset($_GET['Trang'])) {
  $trang = $_GET['Trang'];
  settype($trang,"int");
} else {
  $trang = 1;
}

// tính số trang bắt đầu từ vị trí thứ mấy theo công thức $form = ($trang x $tongsotin1trang)-$tongsotin1trang hoặc ($trang -1)*tongsotin1trang
$from = ($trang-1)*$tongsotin1trang;
// kết nốt đến cơ sở dữ liệu
$contactQuery = "select * from contact_form";
if(isset($_GET['s']) && !empty($_GET['s'])){
$keyword = $_GET['s'];
$contactQuery .= " where id
 like '%$keyword%'
 or email like '%$keyword%'
 or name like '%$keyword%'
 or content like '%$keyword%'
 or phone_number like '%$keyword%'";
};
$contactQuery .=" limit $from, $tongsotin1trang";
$contact = executeQuery($contactQuery, true);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 2 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <?php require_once '../public/style.php'; ?>
    <style>
      .example{
        float: left;
        padding: 10px 15px 10px 30px;
      }
     .example input[type=text] {
  width: 130px;
  -webkit-transition: width 0.4s ease-in-out;
  transition: width 0.4s ease-in-out;
}
form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid grey;
  float: left;
  width: 80%;
  background: #f1f1f1;
}

form.example button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #2196F3;
  color: white;
  font-size: 17px;
  border: 1px solid grey;
  border-left: none;
  cursor: pointer;
}

form.example button:hover {
  background: #0b7dda;
}

form.example::after {
  content: "";
  clear: both;
  display: table;
}
#customers {
  font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color:#3F82CE ;
  color: white;
}
#phantrang a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
}

#phantrang a:active {
  background-color: dodgerblue;
  color: white;
}
#phantrang a:hover {
  background-color: dodgerblue;
  color: white;
}

</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php require_once '../public/header.php'; ?>
<div class="wrapper">
  <?php require_once '../public/sidebar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">


<div>
            <form class="example" action="" style="margin:auto;max-width:300px">
  <input type="text" placeholder="Search.." name="s" value="<?php if(isset($_GET['s'])){
                    echo $_GET['s'];
                  } ?>">
  <button type="submit" name="ok" value="search"><i class="fa fa-search"></i></button>
</form>
        </div>
<table id="customers">
  <tr>
    <th>id</th>
    <th>email</th>
    <th>Tên</th>
    <th>Nội dung</th>
    <th>Số điện thoại</th>
    <th>Xóa</th>
  </tr>
  <?php foreach ($contact as $post): ?>
    <tr>
      <td><?= $post['id'] ?></td>
      <td><?= $post['email'] ?></td>
      <td><?= $post['name'] ?></td>
      <td><?= $post['content'] ?></td>
      <td><?= $post['phone_number'] ?></td>
      <td>
        <a onclick="remove_contact('remove_contact.php?id=<?= $post['id'] ?>')"><span class="glyphicon glyphicon-trash"></span></a>
      </td>
    </tr>
  <?php endforeach ?>
</table>
<?php
// biến đếm số trang
$countContactQuery = "select id from contact_form";
$total = executeQuery($countContactQuery, true);
$tongsotin = count($total);
// dùng hàm ceil để làm tròn lên số trang
$sotrang = ceil($tongsotin / $tongsotin1trang);
 ?>

<div id="phantrang">
  <?php
    for ($i=1; $i <= $sotrang; $i++) {

      echo "<a href='contact.php?Trang=$i' >Trang $i</a>";

    }
   ?>
</div>
</div>
  <!-- /.content-wrapper -->
  <?php require_once '../public/footer.php'; ?>
</div>
<!-- jQuery 3 -->
<?php require_once '../public/script.php'; ?>
</body>
</html>
<script type="text/javascript">
  function remove_contact(url) {
    var conf= confirm('bạn có muốn xóa liên hệ này không ?');
    if (conf) {
      window.location = url;
    }
  }
</script>
