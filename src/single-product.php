<?php
namespace App;

session_start();
require_once("./requests/functions.php");
$currentProduct = Functions::getCurrentProduct($_REQUEST['prId']);
require_once("./requests/logout.php");
require_once("./classes/addtocart.php");
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    switch ($action) {
        case "addtoCart":
            $prToCartId = $_POST['prToCartId'];
            Cart::addToCart($prToCartId);
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product Page</title>

    <?php require_once("./components/requiredFilesHeader.php"); ?>

</head>

<body>

    <?php require_once("./components/header.php"); ?>

    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2><?php echo $currentProduct['product_name'];  ?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="product-breadcroumb">
                            <a href="">Home</a>
                            <a href=""><?php echo $currentProduct['category'];  ?></a>
                            <a href=""><?php echo $currentProduct['subcategory'];  ?></a>
                            <a href=""><?php echo $currentProduct['product_name'];  ?></a>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="product-images">
                                    <div class="product-main-img">
                                        <img src="img/<?php echo $currentProduct['product_image'];  ?>" alt="" width="70%">
                                    </div>

                                    <div class="product-gallery">
                                        <img src="img/product-thumb-1.jpg" alt="">
                                        <img src="img/product-thumb-2.jpg" alt="">
                                        <img src="img/product-thumb-3.jpg" alt="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <h2 class="product-name"><?php echo $currentProduct['product_name'];  ?></h2>
                                    <div class="product-inner-price">
                                        <ins><?php echo '$' . $currentProduct['price'];  ?></ins> <del><?php echo '$' . $currentProduct['list_price'];  ?></del>
                                    </div>

                                    <form method="POST" class="cart">
                                        <input type="hidden" name="prToCartId" value="<?php echo $currentProduct['product_id'];  ?>">
                                        <button class="add_to_cart_button" name="action" value="addtoCart" type="submit">Add to cart</button>
                                    </form>

                                    <div class="product-inner-category">
                                        <p><?php echo $currentProduct['category'];  ?>: <a href="">Summer</a>. Tags: <a href="">awesome</a>, <a href="">best</a>, <a href="">sale</a>, <a href="">shoes</a>. </p>
                                    </div>

                                    <div role="tabpanel">
                                        <ul class="product-tab" role="tablist">
                                            <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Description</a></li>
                                            <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Reviews</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane" id="home">
                                                <h2>Product Description</h2>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam tristique, diam in consequat iaculis, uisque volutpat nulla risus, id maximus ex aliquet ut. Suspendisse potenti. Nulla varius lectus id turpis dignissim porta. Quisque magna arcu, blandit quis  elit, ac sodales nisl. Aliquam eget dolor eget elit malesuada aliquet. In varius lorem lorem, semper bibendum lectus lobortis ac.</p>
                                            </div>
                                            <div role="tabpanel" class="tab-pane" id="profile">
                                                <h2>Reviews</h2>
                                                <div class="submit-review">
                                                    <p><label for="name">Name</label> <input name="name" type="text"></p>
                                                    <p><label for="email">Email</label> <input name="email" type="email"></p>
                                                    <div class="rating-chooser">
                                                        <p>Your rating</p>

                                                        <div class="rating-wrap-post">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <p><label for="review">Your review</label> <textarea name="review" id="" cols="30" rows="10"></textarea></p>
                                                    <p><input type="submit" value="Submit"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>


    <?php require_once("./components/footer.php"); ?>
    <?php require_once("./components/requiredFilesFooter.php"); ?>
</body>

</html>