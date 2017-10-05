<?php
/*
 *
 */

/**
 * Description of CartSession
 *
 * @author Ahmad
 */

class CartSession {

    public static function init_cart(){
    
        try {

            $_SESSION["cart_items"] = array();

        } catch (Exception $ex) {
            throw new CustomException( "Error in : init cart", $ex);
        }

    }
    
    public static function add_item($pid, $quantity, $price, $discount){

        $status = 0;

        try {

            if ( $pid > 0 ) {
            
                $product_object = array();

                $product_object["quantity"] = $quantity;
                $product_object["price"]    = $price;
                $product_object["discount"] = $discount;

                $_SESSION["cart_items"][$pid] = $product_object;

                $status = SUCCESS;
            
            }

        } catch (Exception $e) {
            throw new CustomException( 'Error : add to cart item \n' .  $e->getMessage() . "\n" );
        }

        return $status;
    }
    
    public static function update_item($pid, $quantity, $price, $discount){

        $status = 0;

        try {

            if ( $pid > 0 ) {

                $product_object = array();

                unset( $_SESSION["cart_items"][$pid] );

                $product_object["quantity"] = $quantity;
                $product_object["price"]    = $price;
                $product_object["discount"] = $discount;

                $_SESSION["cart_items"][$pid] = $product_object;

                $status = SUCCESS;
            }

        } catch (Exception $e) {
            throw new CustomException( 'Error : update item \n' .  $e->getMessage() . "\n" );
        }

        return $status;
    }

    public static function remove_item($pid){

        $status = 0;

        try {

            if ( $pid > 0 ) {

                unset( $_SESSION["cart_items"][$pid] );

                $status = SUCCESS;

            }

        } catch (Exception $e) {
            throw new CustomException( 'Error : remove item \n' .  $e->getMessage() . "\n" );
        }

        return $status;
    }
    
    public static function empty_cart(){

        $status = 0;

        try {

            unset( $_SESSION["cart_items"] );

            $_SESSION["cart_items"] = array();

            $status = SUCCESS;

        } catch (Exception $e) {
            throw new CustomException( 'Error : empty cart \n' .  $e->getMessage() . "\n" );
        }

        return $status;
    }
    
    public static function get_item($pid){

        $item = null;

        $items = $_SESSION["cart_items"];

        if (  is_array($items)  ) {
            $item = $items[$pid];
        }

        return $item;
    }

    public static function get_cart_items(){

        $items = array();

        $cart_items = $_SESSION["cart_items"];
        
        foreach ( $cart_items as $pid => $object ) {

            $item = array();

            $item["pid"]      = $pid;
            $item["price"]    = $object["price"];
            $item["quantity"] = $object["quantity"];

            $items[] = $item;
        }

        return $items;
    }

        
    public static function get_total_sale_price(){

        $total_price = 0;
    
        $items = $_SESSION["cart_items"];

        if ( is_array($items) ) {
            foreach ( $items as $item ) {
                $total_price += (  $item["price"] - ( $item["price"] * $item["discount"] )  ) * $item["quantity"];
            }
        }

        return $total_price;
    }
        
    public static function get_total_price(){

        $total_price = 0;
    
        $items = $_SESSION["cart_items"];

        if ( is_array($items) ) {
            foreach ( $items as $item ) {
                $total_price += $item["price"] * $item["quantity"];
            }
        }

        return $total_price;
    }

    public static function get_total_items(){
        
        $total_items = 0;

        $items = $_SESSION["cart_items"];

        if ( is_array($items) ) {
            foreach ( $items as $item ) {
                $total_items += $item["quantity"];
            }
        }

        return $total_items;
    }
    

}

?>