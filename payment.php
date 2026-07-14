<?php
<<<<<<< HEAD
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

=======
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
>>>>>>> 01b832031bddf39edd614db7258974c9518bef82
?>

<div class="page-wrapper">
    <div style="max-width: 700px; margin: 0 auto; padding: 80px 40px; text-align: center;">

<<<<<<< HEAD
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

<p style="font-weight:500;">
    <?= htmlspecialchars($order['address']); ?>
</p>
</div>

<div>
    <p style="font-size:10px; letter-spacing:0.12em; text-transform:uppercase; color:var(--charcoal); margin-bottom:4px">
        Total Paid
</p>

<p style="font-weight:500; color:var(--nude); font-size:18px;">
    &#8369;<?= number_format($order['total'], 2); ?>
</p>
</div>

</div>

<div style="border-top:1px solid var(--border); padding-top:16px;">
    <?php foreach($order['items'] as $item): ?>
        <div style="display:flex; justify-content:space-between; font-size:13px; margin-bottom:10px;">

        <span>
            <?= htmlspecialchars($item['name']); ?>
            &times;
            <?= $item['qty']; ?>
    </spam>

    <span>
        &#8369;<?= number_format(
            (float) str_replace(',', '',
            $item['price']) * $item['qty'],
            2
            ); ?>
            </span>

    </div>
    <?php endforeach; ?>

    </div>

    </div>

    <?php if($order['payment_method'] == 'GCash'): ?>
        <div style="background-color:#e8f4ff; border:1px solid #b3d7ff; padding:20px; text-align:left; margin-bottom:32px;">

        <p style="font-size:12px; font-weight:500; letter-spacing:0.1em; text-transform:uppercase; margin-bottom:10px;">
            GCash Payment Instructions
    </p>

    <p style="font-size:13px; color:var(--charcoal);">
        Please Send
        &#8369;<?= number_format($order['total'], 2); ?>
        To:
        <br>

        <strong>
            09XX-XXX-XXXX (Satifia Official)
    </strong>
    <br>

    Use your order number
    <strong>
        #<?= $order['order_number']; ?>
    <strong>
        as the reference.
    </p>

    </div>

    <?php elseif($order['payment_method'] == 'Bank Transfer'): ?>

        <div style="background-color:#fff8e8; border:1px solid #ffe0b2; padding:20px; text-align:left; margin-bottom:32px;">

        <p style="font-size:12px; font-weight:500; letter-spacing:0.1em; text-transform:uppercase; margin-bottom:10px;">
            Bank Transfer Instructions
    </p>

    <p style="font-size:13px; color:var(--charcoal);">
        Transfer
        $#8369;<?= number_format($order['total'], 2); ?>
        To:
        <br>

        <strong>
            BDO Savings - Account: 0000-1234-5678
            (Satifia Co.)
    </strong>
    <br>

    Include order number
    <strong>
        #<?= $order['order_number']; ?>
    </strong>
    in the remarks.
    </p>

    </div>

    <?php endif; ?>

    <div style="display:flex; gap:16px; justify-content:center;">
        <a href="store.php" class="btn-primary">
            Continue Shopping
    </a>

    <a href="index.php" class="btn-outline">
        Back to Home
    </a>
    </div>

    </div>
</div>

    <?php
    unset($_SESSION['CART']);
    UNSET($_SESSION['order_summary']);

    include('include/footer.php');
    ?>
=======
        <div style="width: 80px; height: 80px; border-radius: 50%; background-color: #e0f2e9; display: flex; align-items: center; justify-content: center; margin: 0 auto 24px; font-size: 36px;">
            &#10003;
        </div>

        <h1 style="font-family: var(--font-display); font-size: 42px; font-weight: 300; margin-bottom: 12px;">
            Order Placed!
        </h1>
        <p style="font-size: 14px; color: var(--charcoal); margin-bottom: 40px;">
            Thank you for your order, <?= htmlspecialchars($_SESSION['buyer_name']); ?>!
            A confirmation will be sent to <strong><?= htmlspecialchars($order['email']); ?></strong>.
        </p>

        <div style="background-color: var(--white); border: 1px solid var(--border); padding: 32px; text-align: left; margin-bottom: 32px;">
            <h2 style="font-family: var(--font-display); font-size: 22px; font-weight:400; margin-bottom: 20px; padding-bottom: 14px; border-bottom: 1px solid var(--border);">
                Order Details
            </h2>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 20px;">
                <div>
                    <p style="font-size: 10px; letter-spacing: 0.12em; text-transform: uppercase; color: var(--charcoal); margin-bottom: 4px;">Order Number</p>
                    <p style="font-weight: 500;">#<?= $order['order_number']; ?></p>
                </div>
                <div>
                    <p style="font-size: 10px; letter-spacing: 0.12em; text-transform: uppercase; color: var(--charcoal); margin-bottom: 4px;">Payment Method</p>
                    <p style="font-weight: 500;"><?= htmlspecialchars($order['payment_method']); ?></p>
                </div>
                <div>
                    <p style="font-size: 10px; letter-spacing: 0.12em; text-transform: uppercase; color: var(--charcoal); margin-bottom: 4px;">Deliver To</p>
                    <p style="font-weight: 500;"><?= htmlspecialchars($order['address']); ?></p>
                </div>
                <div>
                    <p style="font-size: 10px; letter-spacing: 0.12em; text-transform: uppercase; color: var(--charcoal); margin-bottom: 4px;">Total Paid</p>
                    <p style="font-weight: 500; color: var(--nude); font-size: 18px;">&#8369;<?= number_format($order['total'], 2); ?></p>
                </div>
            </div>

            <!-- ITEMS -->
            <div style="border-top: 1px solid var(--border); padding-top: 16px;">
                <?php foreach($order['items'] as $item): ?>
                <div style="display:flex; justify-content:space-between; font-size:13px; margin-bottom:10px;">
                    <span><?= htmlspecialchars($item['name']); ?> &times; <?= $item['qty']; ?></span>
                    <span>&#8369;<?= number_format((float)str_replace(',','',$item['price']) * $item['qty'], 2); ?></span>
                </div>
                <?php endforeach; ?>
            </div>

        </div>

        <?php
        if($order['payment_method'] == 'GCash'):
        ?>
        <div style="background-color: #e8f4ff; border: 1px solid #b3d7ff; padding: 20px; text-align:left; margin-bottom: 32px;">
            <p style="font-size: 12px; font-weight: 500; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 10px;">GCash Payment Instructions</p>
            <p style="font-size: 13px; color: var(--charcoal);">
                Please send &#8369;<?= number_format($order['total'], 2); ?> to:<br>
                <strong>09XX-XXX-XXXX (Satifia Official)</strong><br>
                Use your order number <strong>#<?= $order['order_number']; ?></strong> as the reference.
            </p>
        </div>
        <?php elseif($order['payment_method'] == 'Bank Transfer'): ?>
        <div style="background-color: #fff8e8; border: 1px solid #ffe0b2; padding: 20px; text-align:left; margin-bottom: 32px;">
            <p style="font-size: 12px; font-weight: 500; letter-spacing: 0.1em; text-transform: uppercase; margin-bottom: 10px;">Bank Transfer Instructions</p>
            <p style="font-size: 13px; color: var(--charcoal);">
                Transfer &#8369;<?= number_format($order['total'], 2); ?> to:<br>
                <strong>BDO Savings — Account: 0000-1234-5678 (Satifia Co.)</strong><br>
                Include order number <strong>#<?= $order['order_number']; ?></strong> in the remarks.
            </p>
        </div>
        <?php endif; ?>

        <div style="display: flex; gap: 16px; justify-content: center;">
            <a href="store.php" class="btn-primary">Continue Shopping</a>
            <a href="index.php" class="btn-outline">Back to Home</a>
        </div>
    </div>
</div>

<?php
    unset($_SESSION['cart']);
    unset($_SESSION['order_summary']);
    include('include/footer.php');
?>
>>>>>>> 01b832031bddf39edd614db7258974c9518bef82
