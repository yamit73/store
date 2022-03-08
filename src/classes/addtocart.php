<?php
namespace App;

class Cart
{
    public static function addToCart($prId)
    {
        $product=Functions::getCurrentProduct($prId);
        $cart=isset($_SESSION['cart'])?$_SESSION['cart']:array();
        if (!self::checkProductInSession($prId)) {
            $product['quantity']=1;
            array_push($cart, $product);
            $_SESSION['cart']=$cart;
        } else {
            foreach ($_SESSION['cart'] as $key => $value) {
                if ($prId==$value['product_id']) {
                    $_SESSION['cart'][$key]['quantity']+=1;
                    break;
                }
            }
        }
    }

    public static function checkProductInSession($prId)
    {
        $casrtSession=isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
        foreach ($casrtSession as $value) {
            if ($prId==$value['product_id']) {
                return true;
            }
        }
        return false;
    }

    public static function totalProductInCart()
    {
        $size=0;
        if (isset($_SESSION['cart'])) {
            $size=sizeof($_SESSION['cart']);
        }
        return $size;
    }

    public static function cartTotal()
    {
        $total=0;
        if (isset($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $key => $value) {
                $total += $value['quantity']*$value['price'];
            }
        }
        return $total;
    }

    public static function removeFromCart($prId)
    {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($prId==$value['product_id']) {
                array_splice($_SESSION['cart'], $key, 1);
                break;
            }
        }
    }

    public static function updateQuantityInCart($prId, $updateQuantity)
    {
        foreach ($_SESSION['cart'] as $key => $value) {
            if ($prId==$value['product_id']) {
                $_SESSION['cart'][$key]['quantity']=$updateQuantity;
                break;
            }
        }
    }

    public static function cartDisplay()
    {
        $row='';
        $cart=isset($_SESSION['cart'])?$_SESSION['cart']:array();
        foreach ($cart as $value) {
            $row .='<tr class="cart_item">
                        <td class="product-remove">
                            <a title="Remove this item" class="remove" href="?action=removeFromCart&remPrId='.$value['product_id'].'">X</a>
                        </td>

                        <td class="product-thumbnail">
                            <a href="#"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="img/'.$value['product_image'].'"></a>
                        </td>

                        <td class="product-name">
                            <a href="#">'.$value['product_name'].'</a>
                        </td>

                        <td class="product-price">
                            <span class="amount">$'.$value['price'].'</span>
                        </td>

                        <td class="product-quantity">
                            <div class="quantity buttons_added">
                                <input type="number" size="4" class="input-text qty text" name="updateQty" value="'.$value['quantity'].'" min="0" step="1"><br>
                                <!--<a href="?action=updateQuantity&upId='.$value['product_id'].'">Update</a> -->
                            </div>
                        </td>

                        <td class="product-subtotal">
                            <span class="amount">$'.$value['price']*$value['quantity'].'</span>
                        </td>
                    </tr>';
            
        }
        return $row;
        
    }
}
