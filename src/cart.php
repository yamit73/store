<?php

namespace App;

session_start();
require_once("./classes/addtocart.php");
require_once("./requests/logout.php");
if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
    switch ($action) {
        case "removeFromCart":
            $remPrId = $_REQUEST['remPrId'];
            Cart::removeFromCart($remPrId);
            break;
        // case "updateQuantity":
        //     $updateQty = $_REQUEST['updateQty'];
        //     $upId = $_REQUEST['upId'];
        //     Cart::updateQuantityInCart($upId,$updateQty);
        //     break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cart Page - Ustora Demo</title>

    <?php require_once("./components/requiredFilesHeader.php"); ?>

</head>

<body>

    <?php require_once("./components/header.php"); ?>

    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shopping Cart</h2>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Page title area -->


    <div class="single-product-area">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="product-content-right">
                        <form method="GET" action="#">
                            <table cellspacing="0" class="shop_table cart">
                                <thead>
                                    <tr>
                                        <th class="product-remove">Remove</th>
                                        <th class="product-thumbnail">Product Image</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price">Price</th>
                                        <th class="product-quantity">Quantity</th>
                                        <th class="product-subtotal">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php echo Cart::cartDisplay(); ?>
                                    <tr>
                                        <td class="actions" colspan="6">
                                            <a href="./checkout.php" class="btn btn-primary">Checkout</a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="col">
                <div class="cart_totals">
                    <h2>Cart Totals</h2>
                    <table cellspacing="0">
                        <tbody>
                            <tr class="cart-subtotal">
                                <th>Cart Subtotal</th>
                                <td><span class="amount">$<?php echo Cart::cartTotal(); ?></span></td>
                            </tr>

                            <tr class="shipping">
                                <th>Shipping and Handling</th>
                                <td>Free Shipping</td>
                            </tr>

                            <tr class="order-total">
                                <th>Order Total</th>
                                <td><strong><span class="amount">$<?php echo Cart::cartTotal(); ?></span></strong> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>


    <?php require_once("./components/footer.php"); ?>
    <?php require_once("./components/requiredFilesFooter.php"); ?>

</body>

</html>