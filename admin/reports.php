<?php
    session_start();

    if(!isset($_SESSION['admin_id'])) {
        header('Location: login.php');
        exit();
    }

    $title = "Reports";
    $admin_active = "reports";
    $css_path = "../css/style.css";
    $root_path = "../";

    include('../db.php');
    include('../include/header.php');

    $inv_sql = "SELECT * FROM tblproducts ORDER BY category ASC, name ASC";
    $inv_result = mysqli_query($conn, $inv_sql);
    $total_products = mysqli_num_rows($inv_result);

    $current_admin_id = (int) $_SESSION['admin_id'];
    $log_sql = "SELECT * FROM tblaudit_log WHERE admin_id = '$current_admin_id' ORDER BY date_created DESC LIMIT 50";
    $log_result = mysqli_query($conn, $log_sql);
?>

<div class="admin-layout">
    <?php include('include/admin_sidebar.php'); ?>
    <main class="admin-main">
        <div class="admin-topbar">
            <h1 class="admin-page-title">Reports</h1>
        </div>

        <div class="admin-card">
            <p class="admin-card-title">Inventory Report (<?= $total_products; ?> products)</p>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Remaining Stock</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($item = mysqli_fetch_assoc($inv_result)): ?>
                    <tr>
                        <td><?= $item['id']; ?></td>
                        <td><?= htmlspecialchars($item['name']); ?></td>
                        <td><?= htmlspecialchars($item['category']); ?></td>
                        <td>&#8369;<?= number_format($item['price'], 2); ?></td>
                        <td><?= $item['stock']; ?></td>
                        <td>
                            <?php if($item['stock'] == 0): ?>
                                <span class="badge badge-inactive">Out of Stock</span>
                            <?php elseif($item['stock'] <= 5): ?>
                                <span class="badge badge-staff">Low Stock</span>
                            <?php else: ?>
                                <span class="badge badge-active">In Stock</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- AUDIT LOG -->
        <div class="admin-card">
            <p class="admin-card-title">Audit Log &mdash; Activities by <?= htmlspecialchars($_SESSION['admin_name']); ?></p>

            <?php if(mysqli_num_rows($log_result) > 0): ?>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Date &amp; Time</th>
                        <th>User</th>
                        <th>Activity</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($log = mysqli_fetch_assoc($log_result)): ?>
                    <tr>
                        <td><?= date('M d, Y - h:i A', strtotime($log['date_created'])); ?></td>
                        <td><?= htmlspecialchars($log['admin_name']); ?></td>
                        <td><?= htmlspecialchars($log['action']); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <?php else: ?>
            <p style="font-size:13px; color: var(--charcoal); padding: 20px 0;">No activity recorded yet.</p>
            <?php endif; ?>

        </div>

    </main>
</div>

<?php
    mysqli_close($conn);
    include('../include/footer.php');
?>