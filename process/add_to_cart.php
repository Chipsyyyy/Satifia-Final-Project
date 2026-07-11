<?php
    session_start();

    if(isset($_POST['submit'])) {
        if(!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = array();
        }

        $product_id    = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;
        $product_name  = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_image = isset($_POST['product_image']) ? $_POST['product_image'] : '';

        $found = false;
        foreach($_SESSION['cart'] as $key => $item) {
            if($item['name'] == $product_name) {
                $_SESSION['cart'][$key]['qty']++;
                $found = true;
                break;
            }
        }

        if(!$found) {
            $_SESSION['cart'][] = array(
                'id'    => $product_id,
                'name'  => $product_name,
                'price' => $product_price,
                'image' => $product_image,
                'qty'   => 1
             );
        }

        $_SESSION['cart_msg'] = "\"" . $product_name . "\" added to cart!";
        $redirect = isset($_POST['redirect']) ? '../' . $_POST['redirect'] : '../cart.php';
        header('Location: ' . $redirect);
        exit();

    }
?>