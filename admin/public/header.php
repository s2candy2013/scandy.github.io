<?php
$url = "http://afirebay.ml/admin/";
 ?>
<header class="main-header">
    <!-- Logo -->
    <a href="<?=$url?>index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Admin</b>LTE</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=$_SESSION['save_session']['avatar']?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=$_SESSION['save_session']['name']?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?=$_SESSION['save_session']['avatar']?>" class="img-circle" alt="User Image">

                <p>
                  <?=$_SESSION['save_session']['name']?> - <?=$_SESSION['save_session']['sex']?>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?=$url?>user/profile.php" class="btn btn-default btn-flat">Chi tiết</a>
                </div>
                <div class="pull-right">
                  <a href="<?=$url?>logout.php" class="btn btn-default btn-flat">Đăng xuất</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->

        </ul>
      </div>
    </nav>
  </header>
