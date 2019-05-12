<?php
session_start();
require_once 'dangnhap/db.php';
$idproduct = isset($_GET['id'])?$_GET['id']:'1';
$sql = "select * from products WHERE id = $idproduct";
$dataproduct = run($sql);
// var_dump($dataproduct);die;
$sqlgalery = "select * from product_galleries where pro_id = $idproduct";
$datagalleries = run($sqlgalery, true);
// var_dump($datagalleries);die;
$sqlcmt = "select * from comments where pro_id = $idproduct";
$datacmt = run($sqlcmt, true);
// var_dump($datacmt);die;
$demcmt = "select count(id) as TotalCMT from (select * from comments where pro_id = $idproduct and `status` = 1) as a";
$datademcmt = run($demcmt);
// var_dump($datademcmt);die;
$sqlnd = "select users.`name` as uname,created_at as date,content as content,star as star from comments INNER JOIN users ON comments.user_id = users.id where comments.pro_id = $idproduct and `status` = 1";
$datand = run($sqlnd,true);
// var_dump($datand);die;
$cate_id = $dataproduct['cate_id'];
$query_pro_like = "select * from products where cate_id = $cate_id and id <> $idproduct";
$data_pro_like = run($query_pro_like,true);
?>


<!doctype html>
<html class="no-js" lang="">

<!-- Mirrored from d29u17ylf1ylz9.cloudfront.net/cendo-preview/cendo/single-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Mar 2019 08:45:00 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Cendo | Product Product Detail</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">

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
                    <li class="p-none si-no">
                        <a href="shop.php">Shop</a>
                    </li>
                    <li>
                        <a class="current" href="#">Product Detail</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<section class="single-product-area sit">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-6 none-si-pro">
                <div class="pro-img-tab-content tab-content">
                    <div class="tab-pane active" id="image-1">
                        <div class="simpleLens-big-image-container">
                            <a class="simpleLens-lens-image" data-lightbox="roadtrip" data-lens-image="<?=$dataproduct['image']?>" href="<?=$dataproduct['image']?>">
                                <img src="<?=$dataproduct['image']?>" alt="" class="simpleLens-big-image">
                            </a>
                        </div>
                    </div>
                    <div class="tab-pane" id="image-2">
                        <div class="simpleLens-big-image-container">
                            <a class="simpleLens-lens-image" data-lightbox="roadtrip" data-lens-image="img/product/9-539x761.jpg" href="img/product/9-539x761.jpg">
                                <img src="img/product/9-539x761.jpg" alt="" class="simpleLens-big-image">
                            </a>
                        </div>
                    </div>
                    <div class="tab-pane" id="image-3">
                        <div class="simpleLens-big-image-container">
                            <a class="simpleLens-lens-image" data-lightbox="roadtrip" data-lens-image="img/product/10-539x761.jpg" href="img/product/10-539x761.jpg">
                                <img src="img/product/10-539x761.jpg" alt="" class="simpleLens-big-image">
                            </a>
                        </div>
                    </div>
                    <div class="tab-pane" id="image-4">
                        <div class="simpleLens-big-image-container">
                            <a class="simpleLens-lens-image" data-lightbox="roadtrip" data-lens-image="img/product/4-539x761.jpg" href="img/product/4-539x761.jpg">
                                <img src="img/product/4-539x761.jpg" alt="" class="simpleLens-big-image">
                            </a>
                        </div>
                    </div>
                    <div class="tab-pane" id="image-5">
                        <div class="simpleLens-big-image-container">
                            <a class="simpleLens-lens-image" data-lightbox="roadtrip" data-lens-image="img/product/17-539x761.jpg" href="img/product/17-539x761.jpg">
                                <img src="img/product/17-539x761.jpg" alt="" class="simpleLens-big-image">
                            </a>
                        </div>
                    </div>
                    <div class="tab-pane" id="image-6">
                        <div class="simpleLens-big-image-container">
                            <a class="simpleLens-lens-image" data-lightbox="roadtrip" data-lens-image="img/product/14-539x761.jpg" href="img/product/14-539x761.jpg">
                                <img src="img/product/14-539x761.jpg" alt="" class="simpleLens-big-image">
                            </a>
                        </div>
                    </div>
                </div>

                <div class="pro-img-tab-slider indicator-style2">
                    <?php foreach ($datagalleries as $galleries): ?>
                    <div class="item">
                    	<a href="#image-1" data-toggle="tab">
                    		<img src="<?=$galleries['url']?>" alt="" />
                    	</a>
                    </div>
                    <?php endforeach ?>
                </div>
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-5 col-sm-6">
                <div class="cras">
                    <div class="product-name">
                        <h2><?=$dataproduct['name']?></h2>
                    </div>
                    <div class="pro-rating cendo-pro">
                        <div class="pro_one">
                        	<?php for ($i=0;$i<$dataproduct['star'];$i++): ?>
                                <i class="fa fa-star"></i>
                            <?php endfor?>
                        </div>
                        <p class="rating-links">
                            <a href="#" > <?= $datademcmt['TotalCMT'] ?> Reviews</a>
                        </p>
                    </div>
                    <div class="short-description">
                        <p><?=$dataproduct['short_desc']?></p>
                        <p>Màu sắc: <input type="color" value=" <?=$dataproduct['color']?>" name="color"></p>
                        <p>Chất liệu: <?=$dataproduct['material']?></p>
                        <p>Kích cỡ: <?=$dataproduct['size']?></p>
                        <p>Nhà sản xuất: <?=$dataproduct['manufacturer']?></p>
                    </div>
                    <div class="pre-box">
                        <span class="special-price">$<?=$dataproduct['sell_price']?></span>
                    </div>
                    <div class="add-to-box1">
                        <div class="add-to-box add-to-box2">
                            <div class="add-to-cart">
                                <div class="input-content">
                                    <label for="qty">Quantity:</label>
                                    <input id="qty" class="input-text qty" type="text" name="qty" maxlength="12" value="1" title="Qty">
                                </div>
                                <div class="product-icon">
                                    <?php
                                    $_SESSION['unit_url'] = $_SERVER['REQUEST_URI'];
                                     ?>
                                    <a href="cart/add_cart.php?id=<?=$dataproduct['id'] ?>">
                                        <i class="fa fa-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
<section class="tab_area sing-tab">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12">
                <div class="text">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#home" aria-controls="home" role="tab" data-toggle="tab">Product Description</a>
                        </li>
                        <li role="presentation">
                            <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews (<?= $datademcmt['TotalCMT'] ?>)</a>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home"><?= $dataproduct['detail']?> </div>
                        <div role="tabpanel" class="tab-pane" id="profile">

                        	<!-- BÌNH LUẬN _ COMMENT -->
                            <form class="form-horizontal" action="comment/save_cmt.php" method="POST">
                            	<?php foreach ($datand as $a): ?>
                            	<div id="review">
                                    <table class="table table-striped table-bordered">
                                        <tr>
                                            <td style="width: 50%;">
                                                <strong><?= $a['uname']?></strong>
                                            </td>
                                            <td class="text-right"><?= $a['date']?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <p class="text an-text"><?= $a['content']?></p>
                                                <?php for ($i=0;$i<$a['star'];$i++): ?>
                                                	<i class="fa fa-star"></i>
                                                <?php endfor?>
                                            </td>
                                        </tr>
                                    </table>
                                    <div class="text-right"></div>
                                </div>
                            	<?php endforeach ?>
                                <?php if (isset($_SESSION['save_session'])): ?>
                                <input type="hidden" name="pro_id" value="<?=$dataproduct['id']?>">
                                <h2 class="write">Write a review</h2>
                                <div class="form-group required">
                                    <div class="col-sm-12">
                                        <label class="control-label" for="input-name">Your Name</label>
                                        <input id="input-name" class="form-control" type="text" value="" name="name">
                                        <i id="errname"><?php if (isset($_GET['errname'])): ?>
                                        	<?=$_GET['errname'] ?>
                                        <?php endif ?></i>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <div class="col-sm-12">
                                        <label class="control-label" for="input-review">Your Review</label>
                                        <textarea id="input-review" class="form-control" rows="5" name="content"></textarea>
                                        <i id="errcontent"><?php if (isset($_GET['errcontent'])): ?>
                                        	<?=$_GET['errcontent'] ?>
                                        <?php endif ?></i>
                                    </div>
                                </div>
                                <div class="form-group required">
                                    <div class="col-sm-12">
                                        <label class="control-label">star</label>
                                       	 Bad
                                        <input type="radio" checked value="1" name="star">
                                        <input type="radio" value="2" name="star">
                                        <input type="radio" value="3" name="star">
                                        <input type="radio" value="4" name="star">
                                        <input type="radio" value="5" name="star">
                                         Good
                                    </div>
                                </div>
                                <?php
                                $date_cmt= date("Y-m-d H:i:s");
                                 ?>
                                 <input type="hidden" name="date_cmt" value="<?=$date_cmt?>">
                                <div class="buttons si-button">
                                    <div class="pull-right">
                                        <button id="button-review" class="btn btn-primary" data-loading-text="Loading..." type="submit" value="Submit" name="ok">Submit</button>
                                    </div>
                                </div>
                                <?php endif ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="mostview-area mostview-area2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="title-group-parent grp-three">
                    <div class="featured-slider-title title-group">
                        <h2>Mostviewed</h2>
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
            <div class="active-slider active3 indicator-style2">
                <?php foreach ($data_pro_like as $key => $value): ?>
                <div class="col-md-3">
                    <div class="slider-one">
                        <div class="single-product">
                            <div class="products-top">
                                <p class="price special-price">
                                    <span class="price-new new2"><?=$value['sell_price']?></span>
                                </p>
                                <div class="product-img">
                                    <a href="#">
                                        <img class="primary-image" alt="" src="<?=$value['image']?>">
                                    </a>
                                </div>
                                <div class="ratings reload">
                                    <a class="add" href="cart/add_cart.php?id=<?=$value['id']?>" data-toggle="tooltip" title="add to Cart"> <i class="fa fa-shopping-cart"></i></a>
                                </div>
                            </div>
                            <div class="content-box again">
                                <h2 class="name">
                                    <a href="#"><?=$value['name']?></a>
                                </h2>
                                <div class="price-box">
                                    <?php for($i=0; $i<$value['star']; $i++):?>
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
<div class="icon-slider-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            </div>
        </div>
    </div>
</div>
<?php require_once 'public/footer.php'; ?>

<!-- start scrollUp
============================================ -->
<div id="toTop">
    <i class="fa fa-chevron-up"></i>
</div>



<!-- jquery
============================================ -->
<?php require_once 'public/script.php'; ?>
</body>

<!-- Mirrored from d29u17ylf1ylz9.cloudfront.net/cendo-preview/cendo/single-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Mar 2019 08:45:00 GMT -->
</html>
