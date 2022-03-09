<?php
namespace App;

require_once("/var/www/html/classes/helper.php");
class Functions extends DB
{
    public static function dynamicProductListing($products)
    {
        $html='';
        foreach ($products as $key => $value) {
            $html .= '<div class="col-md-3 col-sm-6">
                    <div class="single-shop-product">
                        <div class="product-upper">
                            <img src="img/'.$value['product_image'].'" alt="" width="80%">
                        </div>
                        <h2><a href="single-product.php?prId='.$value['product_id'].'">'.$value['product_name'].'</a></h2>
                        <div class="product-carousel-price">
                            <ins>$'.$value['price'].'</ins> <del>$'.$value['list_price'].'</del>
                        </div>  
                        
                        <div class="product-option-shop">
                            <a class="add_to_cart_button" rel="nofollow" href="?action=addtoCart&prToCartId='.$value['product_id'].'">Add to cart</a>
                        </div>                       
                    </div>
                </div>';
        }
        echo $html;
    }
    public static function searchProducts($searchtxt)
    {
        try {
            $stmt = DB::getInstance()->query('SELECT product_id, product_image, product_name, category, subcategory, price,list_price FROM products WHERE product_name="'.$searchtxt.'" OR category="'.$searchtxt.'" OR subcategory="'.$searchtxt.'"');
            $result=$stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            echo "Not exexuted user query ".$e;
        }
    }
    public static function getProductSortByPrice($offset)
    {
        try {
            $stmt = DB::getInstance()->query('SELECT product_id, product_image, product_name, category, subcategory, price,list_price FROM products ORDER BY price ASC LIMIT 5 OFFSET '.$offset.'');
            $result=$stmt->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            echo "Not exexuted user query ".$e;
        }
    }
    public static function noOfProducts()
    {
        try {
            $stmt = DB::getInstance()->query('SELECT count(*) as count FROM products');
            $result=$stmt->fetch(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            echo "Not exexuted user query ".$e;
        }
    }
    public static function getCurrentProduct($prid)
    {
        try {
            $stmt = DB::getInstance()->query('SELECT product_id, product_image, product_name, category, subcategory, price,list_price FROM products WHERE product_id='.$prid.'');
            $result=$stmt->fetch(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            echo "Not exexuted user query ".$e;
        }
    }
    public static function checkoutCartDisplay()
    {
        $row='';
        $cart=isset($_SESSION['cart'])?$_SESSION['cart']:array();
        foreach ($cart as $value) {
            $row .='<li class="list-group-item d-flex justify-content-between lh-sm">
                        <div>
                            <h6 class="my-0">'.$value['product_name'].'</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">$'.$value['price']*$value['quantity'].'</span>
                    </li>';
            
        }
        return $row;
        
    }
}
