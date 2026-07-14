<?php 
    session_start();

    if(isset($_POST['submit']) && isset($_POST['cart_key'])) {
        $key = (int)$_POST['cart_key'];
        if(isset($_SESSION['cart'][$key])) {
            unset($_SESSION['cart'][$key]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
        }
     }
     header('Location: ../cart.php');
     exit();

?>