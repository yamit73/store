<?php
namespace App;

session_start();
require_once("./requests/functions.php");
require_once("./requests/pagination.php");
require_once("./classes/addtocart.php");
require_once("./requests/logout.php");
if (isset($_REQUEST['action'])) {
    $action = $_REQUEST['action'];
    switch ($action) {
        case "addtoCart":
            $prToCartId = $_REQUEST['prToCartId'];
            Cart::addToCart($prToCartId);
            break;
        case "search":
            $searchtxt = $_POST['searchTxt'];
            $searchedProducts = Functions::searchProducts($searchtxt);
            break;
    }
}
if (isset($_POST['sortBy'])) {
    $sortBy = $_POST['sortBy'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ustora- Shop</title>

    <?php require_once("./components/requiredFilesHeader.php"); ?>

</head>

<body>

    <?php require_once("./components/header.php"); ?>

    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shop</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row row-cols-lg-auto align-items-center w-75 m-auto mt-4">
        <div class="col-lg-3 col-12">
            <form method="POST">
                <label class="visually-hidden" for="inlineFormSelectPref">Sort By</label>
                <select class="form-select" id="inlineFormSelectPref" name="sortBy" onchange="form.submit()">
                    <option value="price">Price</option>
                    <option value="recentelyAdded" selected>Recently Added</option>
                    <option value="popularity">Popularity</option>
                </select>
            </form>
        </div>
        <div class="col-lg-8 col-12">
            <form method="POST">
                <input type="text" class="form-control w-75 d-inline float-left" name="searchTxt" placeholder="Product name, Category, Subcategory" required>
                <button type="submit" name="action" value="search" class="btn btn-primary w-25 d-inline float-end">Search</button>
            </form>
        </div>
    </div>
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <?php

                if (isset($_POST['searchTxt'])) {
                    Functions::dynamicProductListing($searchedProducts);
                } elseif (isset($_POST['sortBy'])) {
                    $products = Functions::getProductSortByPrice($offset);
                    Functions::dynamicProductListing($products);
                } else {
                    $products = Helper::getProducts($offset);
                    Functions::dynamicProductListing($products);
                }

                ?>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination">
                            <?php
                            if (isset($atpage) && $atpage>=2) {
                                echo '<li class="page-item"><a class="page-link" href="?atpage='.($atpage-1).'">Previous</a></li>';
                            }?>
                                <?php echo pagination() ?>
                            <?php
                            if (isset($atpage) && $atpage<$noOfPages) {
                                echo '<li class="page-item"><a class="page-link" href="?atpage='.($atpage+1).'">Next</a></li>';
                            }?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>


    <?php require_once("./components/footer.php"); ?>
    <?php require_once("./components/requiredFilesFooter.php"); ?>
</body>

</html>