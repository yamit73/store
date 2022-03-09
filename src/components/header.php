<?php
namespace App;

$cuurentPage= basename($_SERVER['PHP_SELF']);
?>
<?php require_once("/var/www/html/classes/addtocart.php"); ?>

<div class="header-area">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="user-menu">
                    <ul>
                        <?php
                        if (isset($_SESSION['currentUser'])) {
                            echo '<li><a href="../dashboard/dashboard.php"><i class="fa fa-user"></i>'.$_SESSION['currentUser']['name'].'</a></li>';
                        }
                                
                        ?>
                        <li><a href="#"><i class="fa fa-heart"></i> Wishlist</a></li>
                        <li><a href="cart.php"><i class="fa fa-user"></i> My Cart</a></li>
                        <?php
                        if (!isset($_SESSION['currentUser'])) {
                            echo '<li><a href="login.php"><i class="fa fa-user"></i> Login</a></li>';
                        } else {
                            echo '<li><a href="?action=logout"><i class="fa fa-user"></i> Logout</a></li>';
                        }
                            
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="site-branding-area">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="logo">
                        <h1><a href="./"><img src="img/logo.png"></a></h1>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="shopping-item">
                        <a href="cart.php">Cart - <span class="cart-amunt">$<?php echo Cart::cartTotal(); ?></span> <i class="fa fa-shopping-cart"></i> <span class="product-count"><?php echo Cart::totalProductInCart(); ?></span></a>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End site branding area -->
    
    <div class="mainmenu-area">
        <div class="container">
            <div class="row">
                <ul class="nav navbar-nav d-inline">
                    
                    <li class="d-inline
                    <?php if ($cuurentPage=="index.php") {
                        echo "active";
}?>"><a href="index.php">Home</a></li>
                    <li class="d-inline <?php if ($cuurentPage=="shop.php") {
                        echo "active";
}?>"><a href="shop.php">Shop page</a></li>
                    <li class="d-inline <?php if ($cuurentPage=="cart.php") {
                        echo "active";
}?>"><a href="cart.php">Cart</a></li>
                    <li class="d-inline <?php if ($cuurentPage=="checkout.php") {
                        echo "active";
}?>"><a href="checkout.php">Checkout</a></li>
                </ul>  
            </div>
        </div>
    </div>