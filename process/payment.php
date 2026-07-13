<?php
session_start();

if(!isset($_SESSION['buyer_id'])) {
    header('Location: login.php');
    exit();
}

if(!isset($_SESSION['order_summary'])) {
    header('Location: cart.php');
    exit();
}

$title = "Order Confirmed";
$active_nav = "";
$order = $_SESSION['order_summary'];

include('include/header.php');
include('include/navigation.php');

?>