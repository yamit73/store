<?php
    require_once("/var/www/html/classes/helper.php");
    class Functions extends DB{

        static function dynamicProductListing(){
            $products=Helper::getProducts();
            $html='';
            foreach($products as $key => $value){
                $html .= '<div class="col-md-3 col-sm-6">
                        <div class="single-shop-product">
                            <div class="product-upper">
                                <img src="img/'.$value['product_image'].'" alt="">
                            </div>
                            <h2 id="'.$value['product_id'].'"><a href="#">'.$value['product_name'].'</a></h2>
                            <div class="product-carousel-price">
                                <ins>$'.$value['price'].'</ins> <del>$'.$value['list_price'].'</del>
                            </div>  
                            
                            <div class="product-option-shop">
                                <a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="'.$value['product_id'].'" rel="nofollow" href="#">Add to cart</a>
                            </div>                       
                        </div>
                    </div>';
            }
            echo $html;
        }
    }

