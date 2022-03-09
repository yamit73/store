<?php
namespace App;

require_once("DB.php");
class Checkout extends DB
{

    public function checkout($orderDetails)
    {
        $this->order($orderDetails);
        $this->orderItems($orderDetails['orderId']);

    }
    private function order($orderDetails)
    {
        $address=$orderDetails['address'].', '.$orderDetails['address2'];
        if (DB::getInstance()) {
            $order='INSERT INTO orders (order_id,user_id,first_name,last_name,email,shipping_address,country,state,shipping_pincode)
                        VALUES ('.$orderDetails['orderId'].',"'.$_SESSION['currentUser']['id'].'","'.$orderDetails['firstName'].'","'.$orderDetails['lastName'].'","'.$orderDetails['email'].'","'.$address.'","'.$orderDetails['country'].'","'.$orderDetails['state'].'",'.$orderDetails['zip'].')';
            DB::getInstance()->exec($order);
        }
    }
    private function orderItems($orderId)
    {
        if (DB::getInstance()) {
            $items='INSERT INTO order_items (order_id,product_id,quantity) VALUES ';
            if (sizeof($_SESSION['cart'])==1) {
                $items .= '('.$orderId.','.$_SESSION['cart']['product_id'].','.$_SESSION['cart']['quantity'].')';
            } else {
                foreach ($_SESSION['cart'] as $key => $val) {
                    if ($key<=sizeof($_SESSION['cart'])-2) {
                        $items .= '('.$orderId.','.$val['product_id'].','.$val['quantity'].'),';
                    } else {
                        $items .= '('.$orderId.','.$val['product_id'].','.$val['quantity'].')';
                    }
                }
            }
            
            //echo(DB::getInstance()->exec($items));
            if (DB::getInstance()->exec($items)) {
                unset($_SESSION['cart']);
                header("location:./thanku.php?orderid=".$orderId."");
            }
        }
    }
}
