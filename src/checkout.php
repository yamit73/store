<?php
namespace App;

session_start();
//print_r($_SESSION['currentUser']);
require_once("./requests/functions.php");
require_once("./requests/logout.php");
require_once("./classes/checkout.php");
if (!isset($_SESSION['currentUser'])) {
    header("location:./login.php");
}
if (!isset($_SESSION['cart'])) {
    echo "<script>alert('cart is empty')</script>";
    header("location:./shop.php");
}
if (isset($_POST['action'])) {
    $action=$_POST['action'];
    $orderDetails=[];
    $orderDetails['firstName']=$_POST['firstName'];
    $orderDetails['lastName']=$_POST['lastName'];
    $orderDetails['email']=isset($_POST['address2'])?$_POST['email']:'';
    $orderDetails['address']=$_POST['address'];
    $orderDetails['address2']=isset($_POST['address2'])?$_POST['address2']:'';
    $orderDetails['country']=$_POST['country'];
    $orderDetails['state']=$_POST['state'];
    $orderDetails['zip']=$_POST['zip'];
    $check=new Checkout();
    switch ($action) {
        case "checkout":
            $orderId= rand(1000, 100000000);
            $orderDetails['orderId']=$orderId;
            $check->checkout($orderDetails);
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ustora- Checkout</title>

    <?php require_once("./components/requiredFilesHeader.php"); ?>

</head>

<body>

    <?php require_once("./components/header.php"); ?>


    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Checkout</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="single-product-area">
        <div class="container">
            <main>
                <div class="row g-5">
                    <div class="col-md-5 col-lg-4 order-md-last">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-primary">Your cart</span>
                            <span class="badge bg-primary rounded-pill"><?php echo Cart::totalProductInCart(); ?></span>
                        </h4>
                        <ul class="list-group mb-3">
                            <?php echo Functions::checkoutCartDisplay(); ?>

                            <li class="list-group-item d-flex justify-content-between bg-light">
                                <div class="text-success">
                                    <h6 class="my-0">Promo code</h6>
                                    <small>EXAMPLECODE</small>
                                </div>
                                <span class="text-success">−$5</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between">
                                <span>Total (USD)</span>
                                <strong>$<?php echo Cart::cartTotal(); ?></strong>
                            </li>
                        </ul>

                        <form class="card p-2">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Promo code">
                                <button type="submit" class="btn btn-secondary">Redeem</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-7 col-lg-8">
                        <h4 class="mb-3">Billing address</h4>
                        <form class="needs-validation" method="POST">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label for="firstName" class="form-label">First name</label>
                                    <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" value="" required>
                                    <div class="invalid-feedback">
                                        Valid first name is required.
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="lastName" class="form-label">Last name</label>
                                    <input type="text" class="form-control" name="lastName" id="lastName" placeholder="" value="" required>
                                    <div class="invalid-feedback">
                                        Valid last name is required.
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Email <span class="text-muted">(Optional)</span></label>
                                    <input type="email" class="form-control" name="email" id="email" placeholder="you@example.com">
                                    <div class="invalid-feedback">
                                        Please enter a valid email address for shipping updates.
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" name="address" id="address" placeholder="1234 Main St" required>
                                    <div class="invalid-feedback">
                                        Please enter your shipping address.
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="address2" class="form-label">Address 2 <span class="text-muted">(Optional)</span></label>
                                    <input type="text" class="form-control" name="address2" id="address2" placeholder="Apartment or suite">
                                </div>

                                <div class="col-md-5">
                                    <label for="country" class="form-label">Country</label>
                                    <select class="form-select" name="country" id="country" required>
                                        <option value="India">India</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid country.
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="state" class="form-label">State</label>
                                    <select class="form-select" name="state" id="state" required>
                                        <option value="Uttar Pradesh">Uttar Pradesh</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please provide a valid state.
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="zip" class="form-label">Zip</label>
                                    <input type="text" class="form-control" name="zip" id="zip" placeholder="Pin code" required>
                                    <div class="invalid-feedback">
                                        Zip code required.
                                    </div>
                                </div>
                            </div>
                            <hr class="my-4">

                            <h4 class="mb-3">Payment</h4>

                            <div class="my-3">
                                <div class="form-check">
                                    <input id="credit" name="paymentMethod" type="radio" class="form-check-input" checked required>
                                    <label class="form-check-label" for="credit">Credit card</label>
                                </div>
                                <div class="form-check">
                                    <input id="debit" name="paymentMethod" type="radio" class="form-check-input" required>
                                    <label class="form-check-label" for="debit">Debit card</label>
                                </div>
                                <div class="form-check">
                                    <input id="paypal" name="paymentMethod" type="radio" class="form-check-input" required>
                                    <label class="form-check-label" for="paypal">PayPal</label>
                                </div>
                            </div>

                            <div class="row gy-3">
                                <div class="col-md-6">
                                    <label for="cc-name" class="form-label">Name on card</label>
                                    <input type="text" class="form-control" name="cc_name" id="cc_name" placeholder="" required>
                                    <small class="text-muted">Full name as displayed on card</small>
                                <div class="invalid-feedback">
                                    Name on card is required
                                </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="cc-number" class="form-label">Credit card number</label>
                                    <input type="text" class="form-control" name="cc_number" id="cc_number" placeholder="" required>
                                <div class="invalid-feedback">
                                    Credit card number is required
                                </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="cc-expiration" class="form-label">Expiration</label>
                                    <input type="text" class="form-control" name="cc_expiration" id="cc_expiration" placeholder="" required>
                                <div class="invalid-feedback">
                                    Expiration date required
                                </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="cc-cvv" class="form-label">CVV</label>
                                    <input type="text" class="form-control" name="cc_cvv" id="cc_cvv" placeholder="" required>
                                <div class="invalid-feedback">
                                    Security code required
                                </div>
                                </div>
                            </div>

                            <hr class="my-4">

                            <button class="w-50 btn btn-primary" type="submit" name="action" value="checkout">Place Order</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
    </div>


    <?php require_once("./components/footer.php"); ?>
    <?php require_once("./components/requiredFilesFooter.php"); ?>
    <script src="./assets/js/form-validation.js"></script>
</body>

</html>
