<?php
    session_start();
    $title = "Your Cart";
    $active_nav = "";

    include('include/header.php');
    include('include/navigation.php');
?>

<div class="page-wrapper">
    <div class="cart-page">

        <h1 class="cart-page-title">
            Your Cart
        </h1>

    </div>
</div>

<?php include('include/footer.php'); ?>