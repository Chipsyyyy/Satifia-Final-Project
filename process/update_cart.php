<?php 
    session_start();

    if(isset($_POST['cart_key']) && isset($_POST['qty'])) {
        $key = (int)$_POST['cart_key'];
        $qty = (int)$_POST['qty'];

        if($qty >= 1 && isset($_SESSION['cart'][$key])) {
            $_SESSION['cart'][$key]['qty'] = $qty;
        }
    }

    header('Location: ../cart.php');
    exit();
    
?>