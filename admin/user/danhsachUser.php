<?php
require_once '../public/db.php';
session_start();
if (!isset($_SESSION['save_session'])) {
  header("location:../dangnhap.php");
}
$id = $_SESSION['save_session']['id'];
$query = "select * from users where id <> '$id'";
// var_dump($query);die;
$listUser = executeQuery($query, true);
$keyword = "";
if (isset($_GET['keyword'])) {
  $keyword = $_GET['keyword'];
}
$query .= " and `name` like '%$keyword%'";
$listUser = executeQuery($query,true);
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
<?php
  require_once '../public/style.php';
 ?>
  <style type="text/css">
    .table td{
      width: 14%;
    }
    #search {
    float: right;
    margin-top: 9px;
    width: 250px;
}

.search {
    padding: 5px 0;
    width: 230px;
    height: 30px;
    position: relative;
    left: 10px;
    float: left;
    line-height: 22px;
}

    .search input {
        position: absolute;
        width: 0px;
        float: left;
        margin-left: 210px;
        -webkit-transition: all 0.7s ease-in-out;
        -moz-transition: all 0.7s ease-in-out;
        -o-transition: all 0.7s ease-in-out;
        transition: all 0.7s ease-in-out;
        height: 30px;
        line-height: 18px;
        padding: 0 2px 0 2px;
        border-radius:1px;
    }

        .search:hover input, .search input:focus {
            width: 200px;
            margin-left: 0px;
        }

.btn {
    height: 30px;
    position: absolute;
    right: 0;
    top: 5px;
    border-radius:1px;
}

  </style>
</head>
<body class="hold-transition skin-blue sidebar-mini">
<?php require_once '../public/header.php'; ?>
<div class="wrapper">
  <?php require_once '../public/sidebar.php'; ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1><i class="fa fa-dashboard"></i>
        Quản lý User
      </h1>
       <div class="container">
          <div class="row">
              <div class="search">
                <form action="danhsachUser.php" method="get">
                  <input type="text" class="form-control input-sm" maxlength="64" placeholder="Search" name="keyword"  value="<?=$keyword?>" />
                  <button type="submit" class="btn btn-primary btn-sm">Search</button>
                </form>
            </div>
          </div>
      </div>
        
    </section>

    <!-- Main content -->
    <section class="content">
      <table  class="table table-bordered table-striped table-reponsive">
        <thead>
            <th>Tên người dùng</th>
            <th>Ảnh đại diện</th>
            <th>Địa chỉ</th>
            <th>Email</th>
            <th>Tuổi</th>
            <th>Giới tính</th>
            <th>Phân quyền</th>
        </thead>
        <tbody>
          <?php foreach ($listUser as $user): ?>
            <tr>
              <td width="100/10%"><?=$user['name'] ?></td>
              <td> <img src="<?=$user['avatar'] ?>" alt="avatar" width ="120px"></td>
              <td><?=$user['address'] ?></td>
              <td><?=$user['email'] ?></td>
              <td><?=$user['age'] ?></td>
              <td><?=$user['sex'] ?></td>
              <td><a href="phanquyen.php?id=<?=$user['id']?>"><i class="fa fa-user" style="font-size: 20px"></i></a></td>
            </tr>
          <?php endforeach ?>

        </tbody>
      </table>
      <!-- Small boxes (Stat box) -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php require_once '../public/footer.php'; ?>
</div>
<!-- jQuery 3 -->
<?php
  require_once '../public/script.php';
 ?>
</body>
</html>
