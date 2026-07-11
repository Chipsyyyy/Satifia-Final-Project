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

            <?php if(isset($_SESSION['cart_msg'])): ?>
            <div class="alert alert-success"><p><?= $_SESSION['cart_msg']; ?></p></div>
            <?php unset($_SESSION['cart_msg']); ?>
        <?php endif; ?>

        <?php if(count($cart) > 0): ?>
        <div class="cart-layout">

            <!-- CART ITEMS -->
            <div>

                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th>Subtotal</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php foreach($cart as $key => $item): ?>

                    <tr>

                        <td>

                            <div class="cart-product-info">

                                <div class="cart-product-img">

                                    <?php if(!empty($item['image']) && file_exists('images/' . $item['image'])): ?>

                                        <img 
                                        src="images/<?= htmlspecialchars($item['image']); ?>" 
                                        alt="<?= htmlspecialchars($item['name']); ?>"
                                        style="width:100%; height:100%; object-fit:cover;">

                                    <?php else: ?>

                                        Photo

                                    <?php endif; ?>

                                </div>


                                <div>

                                    <p class="cart-product-name">
                                        <?= htmlspecialchars($item['name']); ?>
                                    </p>

                                    <p class="cart-product-cat">
                                        Satifia
                                    </p>

                                </div>

                            </div>

                        </td>


                        <td>
                            &#8369;<?= $item['price']; ?>
                        </td>


                        <td>

                            <form action="process/update_cart.php" method="post" style="display:inline;">

                                <input 
                                type="hidden" 
                                name="cart_key" 
                                value="<?= $key; ?>">

                                <input 
                                type="number" 
                                class="cart-qty-input" 
                                name="qty"
                                value="<?= $item['qty']; ?>" 
                                min="1" 
                                max="99"
                                onchange="this.form.submit()">

                            </form>

                        </td>


                        <td>
                            &#8369;<?= number_format((float)str_replace(',','',$item['price']) * $item['qty'], 2); ?>
                        </td>


                        <td>

                            <form action="process/remove_from_cart.php" method="post">

                                <input 
                                type="hidden" 
                                name="cart_key" 
                                value="<?= $key; ?>">

                                <button 
                                type="submit" 
                                name="submit" 
                                class="cart-remove-btn">
                                    &times;
                                </button>

                            </form>

                        </td>


                    </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>


                <div style="margin-top: 20px; display: flex; gap: 12px;">

                    <a href="store.php" class="btn-outline">
                        &#8592; Continue Shopping
                    </a>


                    <form action="process/clear_cart.php" method="post">

                        <button 
                        type="submit" 
                        name="submit" 
                        class="btn-outline"
                        style="border-color: var(--danger); color: var(--danger);"
                        onclick="return confirm('Clear your entire cart?')">
                            Clear Cart
                        </button>

                    </form>

                </div>


            </div>

        </div>


        <?php else: ?>

        <div style="text-align:center; padding: 80px 20px;">

            <p style="font-family: var(--font-display); font-size: 32px; font-weight:300; margin-bottom:12px;">
                Your cart is empty.
            </p>

            <p style="font-size: 14px; color: var(--charcoal); margin-bottom: 28px;">
                Looks like you haven't added anything yet.
            </p>

            <a href="store.php" class="btn-primary">
                Start Shopping
            </a>

        </div>

        <?php endif; ?>

        


    </div>
</div>

<?php include('include/footer.php'); ?>