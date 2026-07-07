<?php
    session_start();

    if(!isset($_SESSION['admin_id'])) {
        header('Location: login.php');
        exit();
    }

    $is_edit = isset($_GET['id']);
    $title = $is_edit ? "Edit Product" : "Add Product";
    $admin_active = "products";
    $css_path = "../css/style.css";
    $root_path = "../";

    // TODO: If editing, fetch product from DB using $_GET['id']
    $product = array("id"=>"", "name"=>"", "category"=>"", "price"=>"", "stock"=>"");

    include('../include/header.php');
?>

<div class="admin-layout">
    <?php include('include/admin_sidebar.php'); ?>
    <main class="admin-main">
        <div class="admin-topbar">
            <h1 class="admin-page-title"><?= $is_edit ? 'Edit Product' : 'Add New Product'; ?></h1>
            <a href="products.php" class="btn-outline">&larr; Back to Products</a>
        </div>

        <?php if(isset($_SESSION['admin_errors'])): ?>
            <div class="alert alert-danger">
                <?php foreach($_SESSION['admin_errors'] as $e): ?>
                    <p><?= $e; ?></p>
                <?php endforeach; ?>
            </div>
            <?php unset($_SESSION['admin_errors']); ?>
        <?php endif; ?>

        <div class="admin-card" style="max-width: 600px;">
            <p class="admin-card-title"><?= $is_edit ? 'Edit Product Details' : 'New Product'; ?></p>

            <form action="process/save_product.php" method="post" novalidate>
                <input type="hidden" name="product_id" value="<?= $product['id']; ?>">

                <div class="form-group">
                    <label class="form-label">Product Name</label>
                    <input type="text" class="form-control" name="name"
                        value="<?= htmlspecialchars($product['name']); ?>" placeholder="e.g. Linen Wrap Blouse">
                </div>

                <div class="form-group">
                    <label class="form-label">Category</label>
                    <select class="form-control" name="category">
                        <option value="">-- Select Category --</option>
                        <?php
                        $cats = array("Tops", "Bottoms", "Dresses", "Outerwear", "Accessories");
                        foreach($cats as $cat):
                        ?>
                        <option value="<?= $cat; ?>" <?= $product['category'] == $cat ? 'selected' : ''; ?>>
                            <?= $cat; ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Price (&#8369;)</label>
                        <input type="number" class="form-control" name="price" step="0.01" min="0"
                            value="<?= $product['price']; ?>" placeholder="0.00">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Stock Quantity</label>
                        <input type="number" class="form-control" name="stock" min="0"
                            value="<?= $product['stock']; ?>" placeholder="0">
                    </div>
                </div>

                <div style="display:flex; gap: 12px; margin-top: 8px;">
                    <button type="submit" name="submit" class="form-submit" style="width: auto; padding: 14px 32px;">
                        <?= $is_edit ? 'Save Changes' : 'Add Product'; ?>
                    </button>
                    <a href="products.php" class="btn-outline">Cancel</a>
                </div>
            </form>
        </div>
    </main>
</div>

<?php include('../include/footer.php'); ?>




