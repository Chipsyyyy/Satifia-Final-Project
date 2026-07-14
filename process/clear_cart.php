<?php 
    session_start();
     if(isset($_POST['submit'])) {
        $_SESSION['cart'] = array();
    }
    header('Location: ../cart.php');
    exit();

?>