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

    }
?>