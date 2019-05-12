<?php
session_start();
// var_dump($_SESSION['save_session']);die;
if (!isset($_SESSION['save_session'])) {
	header('location:dangnhap/signin.php');die;
}
 ?>

 <!doctype html>
<html class="no-js" lang="">
    
<!-- Mirrored from d29u17ylf1ylz9.cloudfront.net/cendo-preview/cendo/my-account.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Mar 2019 08:44:59 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">

        <title>Cendo | My Account </title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- favicon
		============================================ -->		
       <?php require_once 'public/style.php'; ?>
		<!-- modernizr JS
		============================================ -->		
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
    </head>
    <body>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
        
      <?php require_once 'public/header.php'; ?>
        <!-- mobile-menu-area start -->
        <!-- mobile-menu-area end -->
        <div class="top-contact">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="breadcrumb">
                            <li class="p-none">
                                <a href="#">
                                    <i class="fa fa-home"></i>
                                </a>
                            </li>
                            <li>
                                <a class="current" href="#">My Account</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- end header_area
		============================================ -->
        <section class="collapse_area coll2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <div class="check">
                            <h1>My Account </h1>
                        </div>
                        <div class="faq-accordion">
                            <div class="panel-group pas7" id="accordion" role="tablist" aria-multiselectable="true">
                                <div class="panel panel-default">
                                    <div class="panel-heading" role="tab" id="headingOne">
                                        <h4 class="panel-title">
                                            <a class="collapsed method" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Edit your account information <i class="fa fa-caret-down"></i></a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne" aria-expanded="false" >
                                        <div class="row">
                                            <div class="easy2">
                                                <form class="form-horizontal" method="post" action="save_edit.php" enctype="multipart/form-data">
                                                    <fieldset>
                                                        <legend>Your Personal Details</legend>
                                                        
                                                <h1>
                                                    <img src="<?=$_SESSION['save_session']['avatar']?>" alt="" class="img-circle" width="50px"> My Account Information</h1>
                                                      
                                                        <div class="form-group required">
                                                            <label class="col-sm-2 control-label">Name</label>
                                                            <div class="col-sm-10">
                                                                <input name="name" class="form-control" type="text" placeholder="Last Name" value="<?=$_SESSION['save_session']['name']?>">
                                                            </div>
                                                        </div>


                                                        <div class="form-group required">
                                                            <label class="col-sm-2 control-label">E-Mail</label>
                                                            <div class="col-sm-10">
                                                                <input disabled name="email" class="form-control" type="email" placeholder="E-Mail" value="<?=$_SESSION['save_session']['email']?>">
                                                            </div>
                                                        </div>

                                                        <div class="form-group required">
                                                            <label class="col-sm-2 control-label">Phone Number</label>
                                                            <div class="col-sm-10">
                                                                <input name="phone" class="form-control" type="tel" placeholder="Your phone number" pattern="[0-9]{10}" value="<?=$_SESSION['save_session']['phone']?>">
                                                            </div>
                                                        </div>

                                                         <div class="form-group required">
                                                            <label class="col-sm-2 control-label">Age</label>
                                                            <div class="col-sm-10">
                                                                <input name="age" class="form-control" type="number" placeholder="Tuoi" value="<?=$_SESSION['save_session']['age']?>">
                                                            </div>
                                                        </div>

                                                         <div class="form-group required">
                                                            <label class="col-sm-2 control-label">Gender</label>
                                                            <div class="col-sm-10">
                                                            <select class="form-control" name="sex" id="">
                                                                <option <?php if ($_SESSION['save_session']['sex'] =='men'): ?>
                                                                    selected
                                                                <?php endif ?> value="men">men</option>
                                                                <option <?php if ($_SESSION['save_session']['sex'] =='women'): ?>
                                                                    selected
                                                                <?php endif ?> value="women">women</option>
                                                            </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group required">
                                                            <label class="col-sm-2 control-label">Address</label>
                                                            <div class="col-sm-10">
                                                                <input name="address" class="form-control" type="text" placeholder="Address" value="<?=$_SESSION['save_session']['address']?>">
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="col-sm-2 control-label">Choose image</label>
                                                            <div class="col-sm-10">
                                                                <input name="avatar" class="form-control" type="file">
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                    <div class="buttons clearfix">
                                                        <div class="pull-left">
                                                            <a class="btn btn-default ce5" href="dangnhap/re_password.php">Update passwrod</a>
                                                        </div>
                                                        <div class="pull-right">
                                                            <input class="btn btn-primary ce5" type="submit" value="Update">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php require_once 'public/footer.php'; ?>    
        <!-- start scrollUp
		============================================ -->
        <div id="toTop">
            <i class="fa fa-chevron-up"></i>
        </div>
        <!-- end scrollUp
		============================================ -->    
        
<?php require_once 'public/script.php'; ?>
    </body>

<!-- Mirrored from d29u17ylf1ylz9.cloudfront.net/cendo-preview/cendo/my-account.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Mar 2019 08:44:59 GMT -->
</html>
