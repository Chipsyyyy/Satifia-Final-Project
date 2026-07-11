<?php
session_start();

if(!isset($_SESSION['buyer_id'])) {
    header('Location: login.php');
    exit();
}

if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    header('Location: cart.php');
    exit();
}

$title = "Checkout";
$active_nav = "";

$cart = $_SESSION['cart'];
$subtotal = 0;

foreach($cart as $item) {
    $price = (float) str_replace(',','', $item['price']);
    $subtotal += $price * $item['qty'];
}

$shipping = ($subtotal >= 1500) ? 0 : 150;
$total = $subtotal + $shipping;

