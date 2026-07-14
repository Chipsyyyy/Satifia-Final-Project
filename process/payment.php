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

<div class="page-wrapper">
    <div style="max-width: 700px; margin: 0 auto; padding: 80px 40px; text-align: center;">

    <div style="width:80px; height:80px; border-radius:50%; background-color:#e0f2e9; display:flex; align-items