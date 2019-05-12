<?php
session_start();
require_once '../public/verify.php';
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
.toggle{
float: right;
}
/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0px;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php require_once '../public/header.php'; ?>
<div class="wrapper">
  <?php require_once '../public/sidebar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

<?php require_once '../public/db.php';
// tao ket noi den db
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
$sqlQuery = "select `status`, comments.id, comments.pro_id, comments.content, comments.star, comments.created_at, comments.updated_at, comments.user_id, users.name as 'ten', products.name as 'ten_sp'
from comments inner join users on comments.user_id=users.id inner join products on comments.pro_id=products.id
";
 if(isset($_GET['s']) && !empty($_GET['s'])){
$keyword = $_GET['s'];
$sqlQuery .= " where comments.id
 like '%$keyword%'
 or pro_id like '%$keyword%'
 or content like '%$keyword%'
 or created_at like '%$keyword%'
 or updated_at like '%$keyword%'
 or user_id like '%$keyword%'
 or users.name like '%$keyword%'
 or products.name like '%$keyword%'
 or `status` like '%$keyword%'";
};
$sqlQuery .=" limit $from, $tongsotin1trang";
$data = executeQuery($sqlQuery, true);
?>
        <form class="example" action="" style="margin:auto;max-width:300px">
  <input type="text" placeholder="Search.." name="s" value="<?php if(isset($_GET['s'])){
                    echo $_GET['s'];
                  } ?>">
  <button type="submit" name="ok" value="search"><i class="fa fa-search"></i></button>
</form>

<table id="customers">
  <tr>
    <th>id</th>
    <th>Mã sản phẩm chứa bình luận</th>
    <th>Tên sản phẩm chứa bình luận</th>
    <th>Nội dung bình luận</th>
    <th>Số sao</th>
    <th>Ngày tạo</th>
    <th>Chỉnh sửa lần cuối</th>
    <th>Mã người dùng bình luận</th>
    <th>Tên người dùng bình luận</th>
    <th>Xóa</th>
    <th>Xem</th>
    <th>Duyệt bình luận</th>
  </tr>
  <?php foreach ($data as $post): ?>
    <tr>
      <td><?= $post['id'] ?></td>
      <td><?= $post['pro_id'] ?></td>
      <td><a title="Chi tiết sản phẩm" target="_blank" href="/product-detail.php?id=<?= $post['pro_id'] ?> "><?= $post['ten_sp'] ?>
        </a></td>
      <td><?= $post['content'] ?></td>
      <td><?= $post['star'] ?></td>
      <td><?= $post['created_at'] ?></td>
      <td><?= $post['updated_at'] ?></td>
      <td><?= $post['user_id'] ?></td>
      <td><?= $post['ten'] ?></td>
      <td>
        <a onclick="remove_comment('remove_comment.php?id=<?= $post['id'] ?>')"><span class="glyphicon glyphicon-trash"></span></a>
      </td>
      <td>
        <a href="detail_comments.php?id=<?= $post['id'] ?>">
          <span class="glyphicon glyphicon-search"></span>
        </a>
      </td>
      <td>
        <form action="cp-save.php" method="post">
          <input type="hidden" name="id" value="<?=$post['id']?>">
          <div class="toggle">
            <label class="switch">
              <input name="status" value="1" type="checkbox"  <?php if ($post['status'] == 1): ?>
              checked
              <?php endif ?>
              onchange="this.form.submit()">
              <span class="slider round"></span>
            </label>
          </div>
        </form>
    </td>
    </tr>
  <?php endforeach ?>
</table>
<?php
// biến đếm số trang
$countCommentQuery = "select id from comments";
$total = executeQuery($countCommentQuery, true);
$tongsotin = count($total);
// dùng hàm ceil để làm tròn lên số trang
$sotrang = ceil($tongsotin / $tongsotin1trang);
 ?>

<div id="phantrang">
  <?php
    for ($i=1; $i <= $sotrang; $i++) {

      echo "<a href='comments.php?Trang=$i' >Trang $i</a>";

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
  function remove_comment(url) {
    var conf= confirm('bạn có muốn xóa bình luận này không ?');
    if (conf) {
      window.location = url;
    }
  }
</script>
