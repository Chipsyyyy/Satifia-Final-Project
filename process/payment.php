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

    <div style="width:80px; height:80px; border-radius:50%; background-color:#e0f2e9; display:flex; align-items:center; justify-content:center; margin:0 auto 24px; font-size:36px;">
        &#10003;
</div>

<h1 style="font-family:var(--font-display); font-size:42px; font-weight:300; margin-bottom:12px;">
    Order Placed!
</h1>

<p style="font-size:14px; color:var(--charcoal); margin-bottom:40px;">
    Thank you for your order,
    <?= htmlspecialchars($_SESSION['buyer_name']); ?>!

    A confirmation will be sent to
    <strong>
        <?= htmlspecialchars($order['email']); ?>
</strong>.
</p>

<div style="background-color:var(--white); border:1px solid var(--border); padding:32px; text-align:left; margin-bottom:32px;">
    <h2 style="font-family:var(--font-display); font-size:22px; font-weight:400; margin-bottom:20px; padding-bottom:14px; border-bottom:1px solid var(--border);">
        Order Details
</h2>

<div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:20px;">
    <div>
        <p style="font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--charcoal); margin-bottom:4px;">
            Order Number
</p>

<p style="font-weight:500;">
    #<?= $order['order_number']; ?>
</p>
</div>

<div>
    <p style="font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--charcoal); margin-bottom:4px;">
        Payment Method
</p>

<p style="font-weight:500;">
    <?= htmlspecialchars($order['payment_method']); ?>
</p>
</div>

<div>
    <p style="font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--charcoal); margin-bottom:4px;">
        Deliver To
</p>