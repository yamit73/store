<?php
    require_once("./requests/functions.php");
    require_once("./classes/addtocart.php");
    
    if(isset($_REQUEST['action'])){
        $action=$_REQUEST['action'];
        switch($action){
            case "logout":
                session_unset();
                header("location:index.php");
                break;
            case "addtoCart":
                $prToCartId=$_REQUEST['prToCartId'];
                Cart::addToCart($prToCartId);
                break;
            // case "search":
            //     $searchtxt=$_POST['searchTxt'];
            //     $searchedProducts=Functions::searchProducts($searchtxt);
            //     break;
        }
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
    <form method="POST" class="row row-cols-lg-auto align-items-center w-75 m-auto mt-4">
        <div class="col-lg-3 col-12">
            <label class="visually-hidden" for="inlineFormSelectPref">Sort By</label>
            <select class="form-select" id="inlineFormSelectPref">
                <option name="sortBy" value="price">Price</option>
                <option name="sortBy" value="recentelyAdded" selected>Recently Added</option>
                <option name="sortBy" value="popularity">Popularity</option>
            </select>
        </div>

        <div class="col-lg-6 col-12">
            <label class="visually-hidden" for="inlineFormInputGroupUsername">Search</label>
            <div class="input-group">
            <input type="text" class="form-control" name="searchTxt" placeholder="Product name, Category, Subcategory">
            </div>
        </div>
        
        <div class="col-lg-3 col-12">
            <button type="submit" name="action" value="search" class="btn btn-primary w-100">Search</button>
        </div>
    </form>
    
    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">

                <?php
                        $products=Helper::getProducts();
                        Functions::dynamicProductListing($products);
                 ?>

            </div>
            
            <div class="row">
                <div class="col-md-12">
                <nav aria-label="Page navigation example">
                <ul class="pagination">
                  <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
              </nav>
          </div>
                </div>
            </div>
        </div>
    </div>


    <?php require_once("./components/footer.php"); ?>
    <?php require_once("./components/requiredFilesFooter.php"); ?>
  </body>
</html>