<?php
    session_start();

    if(!isset($_SESSION['admin_id'])) {
        header('Location: login.php');
        exit();
    }

    $title = "Products";
    $admin_active = "products";
    $css_path = "../css/style.css";
    $root_path = "../";

    include('../db.php');
    include('../include/header.php');

    $sql = "SELECT * FROM tblproducts ORDER BY id ASC";
    $result = mysqli_query($conn, $sql);
    $total_products = mysqli_num_rows($result);
?>

<div class="admin-layout">
    <?php include('include/admin_sidebar.php'); ?>
    <main class="admin-main">
        <div class="admin-topbar">
            <h1 class="admin-page-title">Products &amp; Stock</h1>
            <a href="product_form.php" class="btn-primary">+ Add Product</a>
        </div>

        <?php if(isset($_SESSION['admin_success'])): ?>
            <div class="alert alert-success"><p><?= $_SESSION['admin_success']; ?></p></div>
            <?php unset($_SESSION['admin_success']); ?>
        <?php endif; ?>

        <?php if(isset($_SESSION['admin_error'])): ?>
            <div class="alert alert-danger"><p><?= $_SESSION['admin_error']; ?></p></div>
            <?php unset($_SESSION['admin_error']); ?>
        <?php endif; ?>

        <div class="admin-card">
            <p class="admin-card-title">All Products (<?= $total_products; ?>)</p>
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($p = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $p['id']; ?></td>
                        <td><?= htmlspecialchars($p['name']); ?></td>
                        <td><?= htmlspecialchars($p['category']); ?></td>
                        <td>&#8369;<?= number_format($p['price'], 2); ?></td>
                        <td><?= $p['stock']; ?></td>
                        <td>
                            <span class="badge <?= $p['stock'] > 0 ? 'badge-active' : 'badge-inactive'; ?>">
                                <?= $p['stock'] > 0 ? 'In Stock' : 'Out of Stock'; ?>
                            </span>
                        </td>
                        <td>
                            <a href="product_form.php?id=<?= $p['id']; ?>" style="color: var(--nude); font-size: 13px; margin-right:10px;">Edit</a>
                            <form action="process/delete_product.php" method="post" style="display:inline;">
                                <input type="hidden" name="product_id" value="<?= $p['id']; ?>">
                                <button type="submit" name="submit"
                                    style="background:none; border:none; color: var(--danger); font-size:13px; cursor:pointer; font-family: var(--font-body);"
                                    onclick="return confirm('Delete this product?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </main>
</div>

<?php
    mysqli_close($conn);
    include('../include/footer.php');
?>




