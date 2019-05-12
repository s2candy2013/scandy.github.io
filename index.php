<?php
session_start();

require_once 'dangnhap/db.php';
$query_pro = "select * from products";
// $star = "select * from comments";
$pro = run($query_pro,true);
$pro_order = run($query_pro." order by id desc limit 6",true);
$pro_sell = run($query_pro." order by sell_price asc limit 4",true);
$slider = "select * from sliders order by sort_order asc";
$sli = run($slider, true);
//search:
$keyword = "";
if (isset($_GET['keyword'])) {
        $keyword = $_GET['keyword'];
}
$search_query = "select * from products where `name` like '%$keyword%'";
// var_dump($pro_order);die;
$_SESSION['unit_url'] = $_SERVER['REQUEST_URI'];

 ?>
<!doctype html>
<html class="no-js" lang="">

<!-- Mirrored from d29u17ylf1ylz9.cloudfront.net/cendo-preview/cendo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Mar 2019 08:43:10 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<link rel="shortcut icon" type="image/png" href="upload/logo/icon_ai.png">
<title>Sofa | Home </title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">

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
<section class="slider-main-area">
<div class="main-slider an-si">
<div class="bend niceties preview-2">
<div id="ensign-nivoslider-2" class="slides">
	<?php foreach ($sli as $key): ?>
		<img src="<?=$key['image_url']?>" alt="Ảnh hiện không tồn tại, vui lòng quay lại sau" title="#slider-direction-<?=$key['sort_order']?>"  />
	<?php endforeach ?>
</div>
<!-- direction 1 -->
<?php foreach ($sli as $key): ?>
<div id="slider-direction-<?=$key['sort_order']?>" class="t-cn slider-direction Builder">
    <div class="slide-all">
        <!-- layer 1 -->
        <div class="layer-1">
            <h2 class="title5"><?=$key['title']?></h2>
        </div>
        <!-- layer 2 -->
        <div class="layer-2">
            <h2 class="title6"><?=$key['short_desc']?></h2>
        </div>
        <!-- layer 3 -->
        <div class="layer-3">
            <a class="min1" href="<?=$key['url']?>">Purchase now</a>
        </div>
    </div>
</div>
<?php endforeach ?>
</div>
</div>
</section>
<div class="banner-area1">
</div>
<section class="featured-container">
<div class="container">
<div class="row">
<div class="col-md-12">
    <div class="title-group-parent">
        <div class="featured-slider-title title-group">
            <h2>Featured Products</h2>
            <div class="after-title">
                <span class="content-after-title"></span>
            </div>
            <div class="before-title after-title">
                <span class="content-before-title content-after-title"></span>
            </div>
        </div>
    </div>
</div>
</div>
<div class="row">
<div class="active-slider se7 indicator-style2">
	<?php foreach ($pro as $products ): ?>
    <div class="col-md-3 row-lg">
        <div class="slider-one">

        	<div class="single-product">
                <div class="products-top">
                    <p class="price special-price non">
                        <span class="price-new">$<?=$products['sell_price']?></span>
                        <span class="price-old">$<?=$products['ori_price']?></span>
                    </p>
                    <div class="product-img">
                        <a href="product-detail.php?id=<?=$products['id']?> ">
                            <img class="primary-image img-xl" alt="" src="<?=$products['image']?>">
                        </a>
                    </div>
                    <div class="ratings">
                        <a class="add" href="cart/add_cart.php?id=<?=$products['id']?>" title="add to Cart"> <i class="fa fa-shopping-cart"></i></a>
                    </div>
                </div>
                <div class="content-box again">
                    <h2 class="name">
                        <a href="#"><?=$products['name']?></a>
                    </h2>
                    <div class="price-box">
                    	<?php for($i=0; $i<$products['star']; $i++):?>
                        	<i class="fa fa-star" style="color: #FFA200"></i>
                        <?php endfor?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach ?>
</div>
</div>

</div>
</section>
<section class="best-seller">
<div class="container">
<div class="row">
<div class="col-md-5 col-sm-5 col-xs-12">
    <div class="title-group2">
        <h2>BESTSELLER PRODUCTS</h2>
    </div>
    <div class="single-slider indicator-style2">
    	<?php foreach ($pro_sell as $p): ?>
    		<div class="single-product an-single">
                <div class="products-top">
                    <p class="price special-price">
                        <span class="price-new new2">$<?=$p['sell_price']?></span>
                    </p>
                    <div class="product-img">
                        <a href="product-detail.php?id=<?=$p['id']?>">
                            <img class="primary-image" alt="" src="<?=$p['image']?>">
                            <img class="secondary-image" alt="" src="<?=$p['image']?>">
                        </a>
                    </div>
                    <div class="ratings">
                        <a class="add" href="cart/add_cart.php?id=<?=$p['id']?>" title="add to Cart"> <i class="fa fa-shopping-cart"></i></a>
                    </div>
                </div>
                <div class="content-box again">
                    <h2 class="name">
                        <a href="#"><?=$p['name']?></a>
                    </h2>
                    <div class="price-box an-prc-box">
                        <?php for($i=0; $i<$p['star']; $i++):?>
                            	<i class="fa fa-star" style="color: #FFA200"></i>
                            <?php endfor?>
                    </div>
                </div>
            </div>
    	<?php endforeach ?>

    </div>
</div>
<div class="col-md-7 col-sm-7 col-xs-12">
    <div class="title-group2">
        <h2>New Products</h2>
    </div>
    <div class="row">
        	<?php foreach ($pro_order as $value): ?>
        	<div class="col-md-4 row-lg">
                    <div class="single-product">
                        <div class="products-top">
                            <p class="price special-price">
                                <span class="price-new new2">$<?=$value['sell_price']?></span>
                            </p>
                            <div class="product-img">
                                <a href="product-detail.php?id=<?=$value['id']?>">
                                    <img class="primary-image img-lg" alt="" src="<?=$value['image']?>">
                                </a>
                            </div>
                            <div class="ratings">
                                <a class="add" href="cart/add_cart.php?id=<?=$value['id']?>" title="add to Cart"> <i class="fa fa-shopping-cart"></i></a>
                            </div>
                        </div>
                        <div class="content-box again">
                            <h2 class="name">
                                <a href="#"><?=$value['name']?></a>
                            </h2>
                            <div class="price-box">
                                <?php for($i=0; $i<$products['star']; $i++):?>
                        			<i class="fa fa-star" style="color: #FFA200"></i>
                        		<?php endfor?>
                            </div>
                        </div>
                    </div>
            </div>
        	<?php endforeach ?>
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
<script language=JavaScript>
    var message="Function Disabled!";
    function clickIE4(){
    if (event.button==2){
    alert(message); return false;
    }
    }
    function clickNS4(e){
    if (document.layers||document.getElementById&&!document.all){
    if (e.which==2||e.which==3){
    alert(message); return false;
    }
    }
    }
    if (document.layers){
    document.captureEvents(Event.MOUSEDOWN); document.onmousedown=clickNS4;
    } else if (document.all&&!document.getElementById){
    document.onmousedown=clickIE4;
    } document.oncontextmenu=new Function("alert(message);return false")


    document.onkeydown = function(e) {
    if (e.ctrlKey &&
    (e.keyCode === 67 ||
    e.keyCode === 86 ||
    e.keyCode === 85 ||
    e.keyCode === 117)) {
    alert('not allowed');
    return false;
    } else {
    return true;
    }
    }
</script>
</body>

<!-- Mirrored from d29u17ylf1ylz9.cloudfront.net/cendo-preview/cendo/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Mar 2019 08:44:02 GMT -->
</html>
