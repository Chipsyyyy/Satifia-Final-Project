<?php
    session_start();

    if(!isset($_SESSION['admin_id'])) {
        header('Location: login.php');
        exit();
    }

    $title = "Dashboard";
    $css_path = "../css/style.css";
    $root_path = "../";

    include('../db.php');
    include('../include/header.php');

    $products_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tblproducts");
    $total_products = mysqli_fetch_assoc($products_result)['total'];

    $orders_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tblorders");
    $total_orders = mysqli_fetch_assoc($orders_result)['total'];

    $buyers_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tblbuyers");
    $total_buyers = mysqli_fetch_assoc($buyers_result)['total'];

    $admins_result = mysqli_query($conn, "SELECT COUNT(*) AS total FROM tbladmins");
    $total_admins = mysqli_fetch_assoc($admins_result)['total'];
?>

<div class="admin-layout">
    <?php include('include/admin_sidebar.php'); ?>
    <main class="admin-main">
        <div class="admin-topbar">
            <h1 class="admin-page-title">Dashboard</h1>
            <span style="font-size:13px; color: var(--charcoal);">Welcome, <?= htmlspecialchars($_SESSION['admin_name']); ?></span>
        </div>

        <div class="admin-stats-grid">
            <div class="stat-card">
                <p class="stat-card-label">Total Products</p>
                <p class="stat-card-value"><?= $total_products; ?></p>
                <p class="stat-card-sub">In inventory</p>
            </div>
            <div class="stat-card">
                <p class="stat-card-label">Total Orders</p>
                <p class="stat-card-value"><?= $total_orders; ?></p>
                <p class="stat-card-sub">All time</p>
            </div>
            <div class="stat-card">
                <p class="stat-card-label">Registered Users</p>
                <p class="stat-card-value"><?= $total_buyers; ?></p>
                <p class="stat-card-sub">Buyers</p>
            </div>
            <div class="stat-card">
                <p class="stat-card-label">Admin Accounts</p>
                <p class="stat-card-value"><?= $total_admins; ?></p>
                <p class="stat-card-sub">Active</p>
            </div>
        </div>
    </main>
</div>

<?php
    mysqli_close($conn);
    include('../include/footer.php');
?>