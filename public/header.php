<?php
require_once 'dangnhap/db.php';
$settingQuery = "select * from settings";
$setting = run($settingQuery); 
?>
<header class="all-header">
    <div class="top_header">
    <div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="top_header_info">
                <ul>
                    <li class="info_mail">
                        <span> Mail:</span>
                        <?= $setting['email'] ;?>
                    </li>
                    <li class="info_phone">
                        <span> Call support free:</span>
                        <?= $setting['hotline']; ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-language lock">
                <ul class="drop-lang">
                	<?php if (isset($_SESSION['save_session'])): ?>
                		<li>
                			<a href="dangnhap/logout.php">logout</a>
                		</li>
                        <li>
                            <a class="rn lnf" href="my-account.php"> My Account </a>
                            <ul class="rn2">
                                <li>
                                    <a href="my-account.php">My Account</a>
                                </li>
                                <li>
                                    <a href="shopping-cart.php">My cart</a>
                                </li>
                            </ul>
                        </li>
                	<?php else: ?>
                    	<li>
                            <a class="rnf" href="dangnhap/signin.php">
                                Login
                            </a>
                            <ul class="sub-lang">
                                <li>
                                    <a href="dangnhap/signup.php">
                                        registration
                                    </a>
                                </li>
                            </ul>
                        </li>
                	<?php endif ?>
                </ul>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="bottom-header">
    <div class="header-inner">  
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="logo">
                    <a href="index.php">
                        <img alt="" src="<?= $setting['logo_url']; ?>">
                    </a>
                </div>
            </div>
            <div class="col-md-9">
                <div class="menu-cart">
                    
                        <div class="muti_menu">
                            <nav>
                                <ul>
                                    <li><a class="fast active" href="index.php">home </a></li>
                                    <li><a class="a-filter add-filter" href="shop.php?sort=new">New product</a></li>
                                    <li><a class="a-filter add-filter" href="shop.php?sort=hot">Hot product</a></li>
                                    <li><a class="a-filter add-filter" href="shop.php?sort=star">reliable products
</a></li>
                                    <li><a href="contact.php">Contact us</a></li>
                                </ul>
                            </nav>
                        </div>
                    
                    <div class="top-cart-wrapper wrap">
                        <div class="top-shop-contain">
                            <div class="block-shop">
                                <div class="top-shop-title">
                                    <a href="shopping-cart.php">
                                        <img alt="" src="img/shopping-cart/topcart.png">
                                        <span class="count co1">
                                            <?php
                                            $count_cart = 0;
                                            if (isset($_SESSION['cart'])) {
                                                foreach ($_SESSION['cart'] as $key => $value) {
                                                       $count_cart+=$value['quantity'];
                                                   }   
                                            }?>
                                            <?= $count_cart?>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="menu-search-top">
                        <form action="shop.php" class="menu-search-mid" method="get">
                            <?php $keyword= isset($_GET['keyword'])?$_GET['keyword']:'' ?>
                            <input class="menu-srch-all" type="text" placeholder="Search" name="keyword" value="<?=$keyword?>"/>
                            <span class="input-bun-top">
                            <button class="menu-search" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                            </span>
                        </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

</header>