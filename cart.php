<?php
    session_start();
    $title = "Your Cart";
    $active_nav = "";
    include('include/header.php');
    include('include/navigation.php');

    // Initialize cart if empty
    if(!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $cart = $_SESSION['cart'];

    // Calculate totals
    $subtotal = 0;
    foreach($cart as $item) {
        $price = (float) str_replace(',', '', $item['price']);
        $subtotal += $price * $item['qty'];
    }
    $shipping = ($subtotal >= 1500) ? 0 : 150;
    $total = $subtotal + $shipping;

?>

<div class="page-wrapper">
    <div class="cart-page">

        <h1 class="cart-page-title">Your Cart
            <span style="font-family: var(--font-body); font-size: 16px; font-weight:300; color: var(--charcoal); margin-left: 12px;">
                (<?= count($cart); ?> item<?= count($cart) != 1 ? 's' : ''; ?>)
            </span>
        </h1>

    </div>
</div>

<?php include('include/footer.php'); ?>