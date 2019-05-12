<?php
require_once 'dangnhap/db.php';
$setting = "select * from settings";
$settingQuery = run($setting); ?>
<footer class="footer-area">
    <div class="container">
    <div class="row">
    <div class="col-md-3 col-sm-4 col-xs-12">
        <div class="footer-title-up">
            <div class="footer-title">
                <h3>About us</h3>
            </div>
            <div class="about-us">
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s</p>
            </div>
            <div class="footer-static-content">
                <a class="add" href="https://www.facebook.com" data-toggle="tooltip" title="Facebook"><i class="fa fa-facebook"></i></a>   
                <a href="http://www.rss.com" class="wishlist" data-toggle="tooltip" title="Rss"><i class="fa fa-rss"></i></a>
               <a href="https://twitter.com" class="wishlist" data-toggle="tooltip" title="Twitter"><i class="fa fa-twitter"></i></a>
                <a href="https://www.instagram.com/" class="search2" data-toggle="tooltip" title="Instagram"><i class="fab fa-instagram"></i></a>
                <a href="https://www.google.com" class="wishlist" data-toggle="tooltip" title="Google"><i class="fa fa-google-plus"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-4 col-xs-12 res-free">
        <div class="footer-title-up">
            <div class="footer-title">
                <h3>My Account</h3>
            </div>
            <div class="footer-content">
                <ul class="toggle-footer">
                    <li>
                        <a href="my-account.php">My Account</a>
                    </li>
                    <li>
                        <a href="shopping-cart.php">Shoping Cart</a>
                    </li>
                    <li>
                        <a href="my-account.php">Update Password</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-3 hidden-sm col-xs-12 res-free">
        <div class="footer-title-up">
            <div class="footer-title">
                <h3>Customer Service</h3>
            </div>
            <div class="footer-content">
                <ul class="toggle-footer">
                    <li>
                        <a href="contact.php">Contact Us</a>
                    </li>
                    <li>
                        <a href="shop.php">For Livingroom</a>
                    </li>
                    <li>
                        <a href="shop.php">For Bedroom</a>
                    </li>
                    <li>
                        <a href="shop.php">For Kitchen</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-3 col-sm-4 col-xs-12 res-free">
        <div class="footer-title-up">
            <div class="footer-title">
                <h3>Contact Us</h3>
            </div>
            <div class="toggle-footer footer-content">
                <span class="address icon">Address: <?=$settingQuery['address']; ?></span>
                <span class="phone icon"><?= $settingQuery['hotline'] ;?></span>
                <span class="email icon"><?= $settingQuery['email'] ;?></span>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="last-footer">
    <div class="container">
    <div class="row">
        <div class="col-md-12 text-center">
            <div class="footer-address">
                <address>
                    Copyright ©
                    <a href="#">Du An 1</a>
                    All Rights Reserved
                </address>
            </div>
        </div>
    </div>
    </div>
    </div>
</footer>
