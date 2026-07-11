<?php
    session_start();

    unset($_SESSION['buyer_id']);
    unset($_SESSION['buyer_name']);
    unset($_SESSION['buyer_email']);
    unset($_SESSION['buyer_address']);
    unset($_SESSION['buyer_contact']);
    session_destroy();
    header('Location: ../login.php');
    exit();
?>