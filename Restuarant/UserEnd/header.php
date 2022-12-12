<?php

session_start();
include('database.inc.php');
include('function.inc.php');
include('constant.inc.php');

if(!isset($_SESSION['IS_LOGIN'])){
    redirect('UserLogin.php');
}


$currStr = $_SERVER['REQUEST_URI'];
$currArr = explode('/', $currStr);
$currPath = $currArr[count($currArr)-1];

$page_title='';
if($currPath == '' || $currPath == 'UserIndex.php' ){
  $page_title = 'My Restuarant';
}
else if($currPath == 'myCart.php' || $currPath == 'manageCart.php'){
  $page_title = 'Restuarant | Cart';
}
else if($currPath == 'UserLogin.php'){
  $page_title = 'Restuarant | Login';
}
else if($currPath == 'checkout.php'){
  $page_title = 'Restuarant | Checkout';
}
else if($currPath == 'order_history.php'){
  $page_title = 'Restuarant | Order History';
}
else if($currPath == 'ResetPass.php' || $currPath == 'verification.php'){
  $page_title = 'Restuarant |  Reset Password';
}
else if($currPath == 'UserRegister.php'){
  $page_title = 'Restuarant | Register!';
}



$id = $_SESSION['IS_LOGIN'];
$sql="select count(quantity) from cart where user_id ='$id'";
$res = mysqli_query($con,$sql);
$row = mysqli_fetch_assoc($res);

$sql1="select sum(c.quantity*d.price) from cart c , dish_detail d where c.user_id = '$id' and c.dish_detail_id = d.id;";
$res1 = mysqli_query($con,$sql1);
$row1 = mysqli_fetch_assoc($res1);



?>
<!doctype html>
<html class="no-js" lang="zxx">
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo $page_title?></title> <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="assets/css/animate.css">
        <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
        <link rel="stylesheet" href="assets/css/slick.css">
        <link rel="stylesheet" href="assets/css/chosen.min.css">
        <link rel="stylesheet" href="assets/css/ionicons.min.css">
        <link rel="stylesheet" href="assets/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/simple-line-icons.css">
        <link rel="stylesheet" href="assets/css/jquery-ui.css">
        <link rel="stylesheet" href="assets/css/meanmenu.min.css">
        <link rel="stylesheet" href="assets/css/style.css">
        <link rel="stylesheet" href="assets/css/responsive.css">
        <script src="assets/js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    </head>
    <body>
        <!-- header start -->
        <header class="header-area">
            <div class="header-top black-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12 col-sm-4">
                            <div class="welcome-area">
                                
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-12 col-sm-8">
                            <div class="account-curr-lang-wrap f-right">
                                <ul>
                                    <li class="top-hover"><a href="#"><?php
                                         echo $_SESSION['ADMIN_USER'];
                                    ?><i class="ion-chevron-down"></i></a>
                                        <ul>
                                            <li><a href="profile.php">My Profile</a></li>
                                            <li><a href="order_history.php">Order History</a></li>
                                            <li><a href="logout.php">Logout</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-middle">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-12 col-sm-4">
                            <div class="logo">
                                <a href="UserIndex.php">
                                    <img alt="" src="assets/img/logo/logo.png">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-9 col-md-8 col-12 col-sm-8">
                            <div class="header-middle-right f-right">
                                <div class="header-login">
                                </div>

                                <span class="cart-text">
                                    
                                </span>
                                <div class="header-wishlist">
                                   &nbsp;
                                </div>
                               
                                <div class="header-cart">
                                    <a href="myCart.php">
                                        <div class="header-icon-style">
                                            <i class="icon-handbag icons"></i>
                                            <span class="count-style" value="0">
                                                <?php
                                                   
                                                    echo implode($row);
                                                    
                                                    
                                                ?>
                                            </span>
                                        </div>
                                        
                                        <div class="cart-text">
                                            <span class="digit" value="0">My Cart</span>
                                            <span class="cart-digit-bold" value=0>
                                                <?php
                                                
                                                    
                                                    echo "Rs: ".implode($row1);
                                                ?>
                                            </span>
                                        </div>
                                    </a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom transparent-bar black-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="main-menu">
                                <nav>
                                    <ul>
                                        <li><a href="UserIndex.php">Shop</a></li>
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- mobile-menu-area-start -->
			<div class="mobile-menu-area">
				<div class="container">
					<div class="row">
						<div class="col-lg-12">
							<div class="mobile-menu">
								<nav id="mobile-menu-active">
									<ul class="menu-overflow" id="nav">
										<li><a href="shop.php">Home</a></li>
									</ul>
								</nav>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- mobile-menu-area-end -->
        </header>