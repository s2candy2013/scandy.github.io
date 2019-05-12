<?php 
session_start();
$_SESSION['UNIT_URL']=$_SERVER['REQUEST_URI'];
 ?>
<!doctype html>
<html class="no-js" lang="">
    
<!-- Mirrored from d29u17ylf1ylz9.cloudfront.net/cendo-preview/cendo/shopping-cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 22 Mar 2019 08:45:00 GMT -->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Sofa | Shopping-Cart</title>
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
                                <a class="current" href="shop.php">Shopping Cart</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
         <!-- start shopping-cart-area
        ============================================ -->
        <div class="shopping-cart-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="s-cart-all">
                            <div class="page-title">
                                <h1>Shopping Cart</h1>
                            </div>
                            <div class="cart-form table-responsive ma">
                                <table id="shopping-cart-table" class="data-table cart-table">
                                    <tr>
                                        <th>Images</th>
                                        <th>Product Name</th>
                                        <th>short_desc</th>
                                        <th>Qty</th>
                                        <th>Unit Price</th>
                                        <th>Total</th>
                                        <th>column_remove</th>
                                    </tr>
                                    <?php $cart = isset($_SESSION['cart'])? $_SESSION['cart']: [];?>
                                    <?php foreach ($cart as $key => $c ): ?>
                                    	<tr>
                                        <td class="sop-cart">
                                            <a href="#"><img class="primary-image" alt="" src="<?=$c['image']?>"></a>
                                        </td>
                                        <td class="sop-cart"><a href="#"><?=$c['name']?></a></td>
                                        <td class="sop-cart"><?=$c['short_desc']?></td>
                                        <td class="cen">
                                            <div class="tas ce-ta">
                                                <a class="add" title="" data-toggle="tooltip" href="cart/update_cart.php?id=<?=$key?>&type=giam" data-original-title="giảm">-</a>
                                            <input class="input-text qty" type="text" name="qty" maxlength="12" value="<?=$c['quantity']?>" title="Qty">
                                                <a class="add" title="" data-toggle="tooltip" href="cart/update_cart.php?id=<?=$key?>&type=tang" data-original-title="tăng">+</a>
                                            </div>
                                        </td>
                                        <td class="sop-cart">$<?=$c['sell_price']?></td>
                                        <td class="sop-cart">$<?=$c['total']?></td>
                                        <td class="sop-icon">
                                            <div class="tas">
                                                <a class="add" title="" data-toggle="tooltip" href="cart/remove_cart.php?id=<?=$key?>"   data-original-title="Remove">
                                                    <i class="fa fa-times-circle"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach ?>
                                    
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end shopping-cart-area
        ============================================ -->
        <section class="shop-collaps-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="like">
                            <h2>What would you like to do next?</h2>
                            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12  col-xs-12">
                        <table class="table table-bordered">
                            <tr>
                                <td class="text-center">
                                    <strong>Sub-Total:</strong>
                                </td>
                                <td class="text-center">
                                    <?php $subtotal=0; 
                                    foreach ($cart as$value) {
                                        $subtotal+=$value['total'];
                                    }
                                    ?>$<?= $subtotal ?>
                                        
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <strong>Shipping:</strong>
                                </td>
                                <td class="text-center">$100</td>
                            </tr>
                            <tr>
                                <td class="text-center">
                                    <strong>Total:</strong>
                                </td>
                                <td class="text-center">$<?= $subtotal+100 ?></td>
                            </tr>
                        </table>
                        <div class="buttons">
                            <div class="pull-left">
                                <a href="shop.php">
                                    <button class="button bn7">
                                        <span>
                                            <span>Continue Shopping</span>
                                        </span>
                                    </button>
                                </a>
                            </div>
                            <div class="pull-right no9">
                                <button class="button bn7">
                                    <span>
                                        <a href="checkout.php">
                                        <span>Checkout</span>
                                        </a>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="icon-slider-area">
            <div class="container">
                <div class="row">          

                </div>
            </div>
        </div>
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
<script 


language=JavaScript> var message="Function Disabled!"; 
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