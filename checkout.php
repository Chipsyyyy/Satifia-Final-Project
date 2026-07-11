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

include('include/header.php');
include('include/navigation.php');
?>

<div class="page-wrapper">
    <div class="checkout page">
        <h1 style="font-family: var(--font-display); font-size: 36px; font-weight: 300; margin-bottom: 36px;">
            Checkout
        </h1>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger">
                <?php foreach($_SESSION['errors'] as $error): ?>
                    <p><?= $error ?></p>
                <?php endforeach; ?>
            </div>

            <?php unset($_SESSION['errors']); ?>
            <?php endif; ?>

            <form action="process/process_checkout.php" method="post" novalidate>
                <div class="checkout-layout">

                <div>
                    <h2 class="checkout-section-title">
                        Shipping Information
                    </h2>

                    <div class="form-group">
                        <label class="form-label" for="recv_name">
                            Recipient Name
                        </label>

                        <input
                        type="text"
                        class="form-control"
                        name="recv_name"
                        id="recv_name"
                        placeholder="Full name of the recipient"
                        value="<?= htmlspecialchars($_SESSION['buyer_name']) ?>"
                        >
                </div>

                <div class="form-group">
                        <label class="form-label" for="recv_address">
                            Delivery Adress
                        </label>

                        <input
                        type="text"
                        class="form-control"
                        name="recv_address"
                        id="recv_address"
                        placeholder="Street, Barangay, City, Province"
                        value="<?= htmlspecialchars($_SESSION['buyer_address']) ?>"
                        >
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="recv_contact">
                            Contact Number
                        </label>

                        <input
                        type="text"
                        class="form-control"
                        name="recv_contact"
                        id="recv_contact"
                        placeholder="09XXXXXXXXX"
                        value="<?= htmlspecialchars($_SESSION['buyer_contact']) ?>"
                        >
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="recv_email">
                            Email
                        </label>
                        
                        <input
                        type="email"
                        class="form-control"
                        name="recv_email"
                        id="recv_email"
                        placeholder="For order confirmation"
                        value="<?= htmlspecialchars($_SESSION['buyer_email']) ?>"
                        >
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="notes">
                        Order Notes (Optional)
                    </label>

                    <input
                    type="text"
                    class="form-control"
                    name="notes"
                    id="notes"
                    placeholder="Any special instructions?"
                    >
                </div>

                <h2 class="checkout-section-title" style="margin-top: 36px;">
                    Payment Method
                </h2>

                <div style="display: flex; flex-direction: column; gap: 12px; margin-bottom: 24px;">
                    
                <label style="display:flex; align-items: center; gap: 12px; font-size: 14px; cursor: pointer; padding: 14px 16px; border: 1px solid var(--border); background:var(--white); ">
                    <input
                    type="radio"
                    name="payment_method"
                    value="cod"
                    checked
                    >
                    Cash on Delivery (COD)
                </label>

                <label style="display:flex; align-items: center; gap: 12px; font-size: 14px; cursor: pointer; padding: 14px 16px; border: 1px solid var(--border); background:var(--white); ">
                    <input
                    type="radio"
                    name="payment_method"
                    value="gcash"
                    >
                    GCash
                </label>

                <label style="display:flex; align-items: center; gap: 12px; font-size: 14px; cursor: pointer; padding: 14px 16px; border: 1px solid var(--border); background:var(--white); ">
                    <input
                    type="radio"
                    name="payment_method"
                    value="bank"
                    >
                    Bank Transfer
                </label>

                </div>

                <button type="submit" name="submit" class="btn-primary">
                    Place Order &rarr;
                </button>
                </div>

                <div class="checkout-order-summary">
                    <h2 class="cart-summary-title">
                        Order Summary
                    </h2>

                    <?php foreach($cart as $item): ?>
                        <div style="display: flex; justify-content: space-between; font-size: 13px; margin-bottom: 12px; padding-bottom: 12px; border-bottom: 1px solid var(--border);">

                        <span>
                            <?= htmlspecialchars($item['name']); ?>
                            
                            <span style="color: var(--charcoal);">
                                &times; <?= $item['qty']; ?> 
                                </span>
                        </span>

                        <span>
                            &#8369;<?= number_format(
                            (float) str_replace(',','', $item['price']) * $item['qty'],
                             2
                            ); ?>
                        </span>

                        </div>
                    <?php endforeach; ?>

                    <div class="cart-summary-row">
                        <span>Subtotal</span>
                        <span>
                            &#8369;<?= number_format($subtotal, 2); ?>
                        </span>
                    </div>

                    <div class="cart-summary-row">
                        <span>Shipping</span>
                        
                        <span>
                            <?= $shipping == 0
                            ? '<span style="color: var(--sucess)">FREE</span>'
                            : '&#8369;' . number_format($shipping, 2);
                            ?>
                        </span>
                        </div>

                        <div class="cart-summary-total">
                            <span>Total</span>
                            
                            <span>
                                &#8369;<?= number_format($total, 2); ?>
                            </span>
                        </div>
                    </div>
                    </div>
            </form>
                    </div>
                    </div>

                    <?php include('include/footer.php'); ?>