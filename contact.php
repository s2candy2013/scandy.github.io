<?php
require_once 'dangnhap/db.php';
$settingQuery = "select * from settings";
$setting = run($settingQuery);
 ?>
<!doctype html>
<html class="no-js" lang="">
<!-- Mirrored from d29u17ylf1ylz9.cloudfront.net/cendo-preview/cendo/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Mar 2019 14:46:38 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Cendo | Contact</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- favicon
		============================================ -->
       <?php require_once 'public/style.php'; ?>
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
                                <a class="current" href="#">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <section class="top-map-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="map-area">
                            <div class="contact-map">
                                <div style="margin:10px 20px 20px 250px;" id="z"><?= $setting['maps']; ?></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="page-title">
                            <h2>Contact Us</h2>
                            <h3>Our Location</h3>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <strong>E-Mail: <?=$setting['email']; ?></strong>
                                        <br>
                                        <address> Address: <?=$setting['address']; ?> </address>
                                    </div>
                                    <div class="col-sm-3">
                                        <strong>Telephone</strong>
                                        <br>
                                        <?= $setting['phone_number']; ?>
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h3>Contact Form</h3>
                            </div>
                            <form class="cendo" action="contact/lienhe.php" method="post">

                                <div class="form-group required">
                                    <label class="col-md-2 control-label">Your Name</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" value="" name="name">
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-2 control-label">Phone number</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" value="" name="phone_number">
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-2 control-label">E-Mail Address</label>
                                    <div class="col-md-10">
                                        <input class="form-control" type="text" value="" name="email">
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <label class="col-md-2 control-label">Enquiry</label>
                                    <div class="col-md-10">
                                        <textarea name="content" id="content" class="form-control" rows="10" name="message"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="buttons">
                                        <div class="pull-right">
                                            <input class="btn btn-primary" type="submit" value="Submit">
                                        </div>
                                    </div>
                                </div>
                            </form>
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





		<!-- jquery
		============================================ -->
        <?php require_once 'public/script.php'; ?>
        <!-- google map api
		============================================ -->
        <script src="http://maps.googleapis.com/maps/api/js"></script>
         <script>
            var myCenter=new google.maps.LatLng(23.763523, 90.431098);
            function initialize()
            {
                var mapProp = {
                  center:myCenter,
                  scrollwheel: false,
                  zoom:17,
                  mapTypeId:google.maps.MapTypeId.ROADMAP
                  };
                var map=new google.maps.Map(document.getElementById("hastech"),mapProp);
                var marker=new google.maps.Marker({
                  position:myCenter,
                    animation:google.maps.Animation.BOUNCE,
                  icon:'img/map-marker.png',
                    map: map,
                  });

                marker.setMap(map);
            }
            google.maps.event.addDomListener(window, 'load', initialize);
        </script>
		<!-- main JS
		============================================ -->
        <script src="js/main.js"></script>
    </body>

<!-- Mirrored from d29u17ylf1ylz9.cloudfront.net/cendo-preview/cendo/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Mar 2019 14:46:38 GMT -->
</html>
