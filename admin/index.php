<?php
    session_start();

    if(!isset($_SESSION['admin_id'])) {
        header('Location: login.php');
        exit();
    }

    $title = "Dashboard";
    $css_path = "../css/style.css";
    $root_path = "../";
    include('../include/header.php');
?>

<div class="admin-layout">
    <?php include('include/admin_sidebar.php'); ?>
    <main class="admin-main">
        <div class="admin-topbar">
            <h1 class="admin-page-title">Dashboard</h1>
            <span style="font-size:13px; color: var(--charcoal);">Welcome, <?= htmlspecialchars($_SESSION['admin_name']); ?></span>
        </div>
    </main>
</div>

<?php include('../include/footer.php'); ?>