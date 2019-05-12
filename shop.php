<?php 
session_start();
require_once 'dangnhap/db.php';
$queryproduct = "select * from products";
$querycategories = "select * from categories";
$data_categories = run($querycategories,true);
$where = array();
$filter  = array(
    'name'     => isset($_GET['keyword']) ? getConnect()->quote('%'.$_GET['keyword'].'%') : false,
    'cate_id'     => isset($_GET['cate']) ? getConnect()->quote($_GET['cate']) : false,
);
if ($filter['name']) {
    $where[] = "name like {$filter['name']}";
}
if ($filter['cate_id']) {
    $where[] = "cate_id = {$filter['cate_id']}";
}
if ($where){
    $queryproduct .= ' WHERE '.implode(' AND ', $where);
}
if (isset($_GET['sort'])) {
    if ($_GET['sort'] == 'new') {
        $queryproduct.= ' order by id desc';
    }
        if ($_GET['sort'] == 'hot') {
        $queryproduct.= ' order by views desc';
    }    if ($_GET['sort'] == 'star') {
        $queryproduct.= ' order by star desc';
    }
}
// var_dump($queryproduct);die;
$row = run("select count(id) as total from ($queryproduct) as total");
$total_records = $row['total'];
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 8;
$total_page = ceil($total_records / $limit);
if ($current_page > $total_page){
$current_page = $total_page;
}
else if ($current_page < 1){
$current_page = 1;
}
$start = ($current_page - 1) * $limit;
$queryproduct.=" limit $start, $limit";
$dataproduct = run($queryproduct,true);
$_SESSION['unit_url'] = $_SERVER['REQUEST_URI'];
?>

<!doctype html>
<html class="no-js" lang="">

<!-- Mirrored from d29u17ylf1ylz9.cloudfront.net/cendo-preview/cendo/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Mar 2019 14:46:37 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="x-ua-compatible" content="ie=edge">
<title>Cendo | Shop Page</title>
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
        <a class="current" href="#">shop</a>
    </li>
</ul>
</div>
</div>
</div>
</div>
<section class="top-shop-area">
<div class="container">
<div class="row">
<div class="col-md-12 col-sm-12">
<div class="row">

    <div class="col-md-3 col-sm-3">
        <div class="shop-around">
           <div class="all-shop2-area">
                <div class="filter-attribute-container">
                    <div class="block-title">
                        <h2>Category</h2>
                    </div>
                    <div class="layered-content">
                        <div class="cen-shop">
                            <ul>
                                <?php foreach ($data_categories as $key => $value): ?>
                                <?php
                                $cateId = $value['id'];
                                 $total = run("select count(id) as total from products where cate_id = $cateId"); ?>
                                <li>
                                    <a class="a-filter add-filter" href="shop.php?cate=<?=$cateId?>"><?=$value['name'].' ('.$total['total']. ')' ?></a>
                                </li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                </div>
           </div>
        </div>
    </div>
    <div class="col-md-9 col-sm-9 col-xs-9">
        <div class="features-tab fe-again">
          <!-- Nav tabs -->
            <div class="shop-all-tab top-shop-n">
                <div class="two-part an-tw">
                    <ul class="nav tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-th-large"></i> Grid</a></li>
                        <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-align-justify"></i> List</a></li>
                    </ul>
                </div>
            </div>
          <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="home">
                    <div class="row">
                        <div class="shop-tab">
                            <!-- single-product start -->
                            <?php foreach ($dataproduct as $product): ?>
                            	<div class="col-md-3 col-sm-6">
                                <div class="slider-one">
                                    <div class="single-product">
                                        <div class="products-top">
                                            <p class="price special-price">
                                                <span class="price-new new2">$<?=$product['sell_price']?></span>
                                            </p>
                                            <div class="product-img">
                                                <a href="product-detail.php?id=<?=$product['id']?>">
                                                    <img class="primary-image" alt="" src="<?=$product['image']?>">
                                                </a>
                                            </div>
                                            <div class="ratings">
                                                <a class="add" href="cart/add_cart.php?id=<?=$product['id']?>" data-toggle="tooltip" title="add to Cart"> <i class="fa fa-shopping-cart"></i></a>
                                                <a href="product-detail.php?id=<?=$product['id']?>" class="search2" title="Quick View" data-toggle="modal"><i class="fa fa-search"></i></a>
                                            </div>
                                        </div>
                                        <div class="content-box again">
                                            <h2 class="name">
                                                <a href="#"><?=$product['name']?></a>
                                            </h2>
                                            <div class="price-box">

                                                <a>
                                                	<?php for ($i=0;$i<$product['star'];$i++): ?>
                                                	<i class="fa fa-star"></i>
                                                <?php endfor?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach ?>
                            
                        </div>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="profile">
                    <div class="row shop">
                    	<?php foreach ($dataproduct as $product): ?>
                        <div class="li-item" style="padding: 10px 0px;">
                            <div class="col-md-4 col-sm-4 col-xs-12 col-shop">
                                <div class="single-product shop6">
                                    <div class="products-top shop7">
                                        <p class="price special-price">
                                            <span class="price-new new2">$<?=$product['sell_price']?></span>
                                        </p>
                                        <div class="product-img">
                                            <a href="product-detail.php?id=<?=$product['id']?>">
                                                <img class="primary-image" alt="" src="<?=$product['image']?>" width="230px">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8 col-sm-8 col-xs-12 col-shop">
                                <div class="f-fix">
                                    <div class="content-box pro2">
                                        <h2 class="product-name feil">
                                            <a href="#"><?=$product['name']?></a>
                                        </h2>
                                        <div class="shop-next">
                                            <?php for ($i=0;$i<$product['star'];$i++): ?>
                                            	<i class="fa fa-star"></i>
                                            <?php endfor?>
                                        </div>
                                    </div>
                                    <p class="desc"><?=$product['short_desc']?></p>
                                    <div class="p-box">
                                        <span class="special-price">$<?=$product['ori_price']?></span>
                                    </div>
                                    <div class="product-icon">
                                        <a href="cart/add_cart.php?id=<?=$product['id']?>">
                                            <i class="fa fa-shopping-cart"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 text-left">
                    <ul class="pagination">
                    	<?php if ($current_page > 1 && $total_page > 1): ?>
                    		<li><a href="shop.php?page=<?=$current_page-1?>">Prev</a></li>
                    	<?php endif ?>
                    	<?php for ($i = 1; $i <= $total_page; $i++):?>
                    		<?php if ($i == $current_page): ?>
                    			<li class="active">
                           		 <span><?=$i?></span>
                        		</li>
                        	<?php else: ?>
	                            <li>
	                                <a href="shop.php?page=<?=$i?>"><?=$i?></a>
	                            </li>
                    		<?php endif ?>
                    	<?php endfor ?>
                    	<?php if ($current_page < $total_page && $total_page > 1): ?>
                    		<li><a href="shop.php?page=<?=$current_page+1?>">Next</a></li>
                    	<?php endif ?>
                    </ul>
                </div>
                <div class="col-sm-6 text-right"><?php if ($start<0) {$start =0;} ?>
                    Showing <?=$start?> to <?=$start+$limit?> of <?=$total_records?> (<?=$current_page?> Pages)
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

<!-- Mirrored from d29u17ylf1ylz9.cloudfront.net/cendo-preview/cendo/shop.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 20 Mar 2019 14:46:37 GMT -->
</html>
