<?php
    session_start();
    $title = "Shop";
    $active_nav = "store";

    include('db.php');

     // Get category filter from URL
    $category = isset($_GET['category']) ? $_GET['category'] : 'all';


    include('include/header.php');
    include('include/navigation.php');
?>

<div class="page-wrapper">



    <div class="page-title-strip">
        <h1>Shop All</h1>
        <p>Discover the latest pieces from Satifia</p>
    </div>

    <div class="store-layout">

     <!-- FILTER BUTTONS -->
        <div class="store-filter-bar">
            <button class="filter-btn <?= ($category == 'all') ? 'active' : ''; ?>"
                onclick="window.location='store.php'">All</button>
            <button class="filter-btn <?= ($category == 'tops') ? 'active' : ''; ?>"
                onclick="window.location='store.php?category=tops'">Tops</button>
            <button class="filter-btn <?= ($category == 'bottoms') ? 'active' : ''; ?>"
                onclick="window.location='store.php?category=bottoms'">Bottoms</button>
            <button class="filter-btn <?= ($category == 'dresses') ? 'active' : ''; ?>"
                onclick="window.location='store.php?category=dresses'">Dresses</button>
            <button class="filter-btn <?= ($category == 'outerwear') ? 'active' : ''; ?>"
                onclick="window.location='store.php?category=outerwear'">Outerwear</button>
            <button class="filter-btn <?= ($category == 'accessories') ? 'active' : ''; ?>"
                onclick="window.location='store.php?category=accessories'">Accessories</button>
        </div>


     <!-- PRODUCT GRID -->
        <?php
        if($category == 'all') {
            $sql = "SELECT * FROM tblproducts ORDER BY id ASC";
        } else {
            $category_safe = mysqli_real_escape_string($conn, $category);
            $sql = "SELECT * FROM tblproducts WHERE LOWER(category) = '$category_safe' ORDER BY id ASC";
        }

        $result = mysqli_query($conn, $sql);
        $total_products = mysqli_num_rows($result);
        ?>

        <div class="product-grid">
            <?php while($product = mysqli_fetch_assoc($result)): ?>
            <div class="product-card">
                <div class="product-image">
                    <?php if(!empty($product['image']) && file_exists('images/' . $product['image'])): ?>
                        <img src="images/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>">
                    <?php else: ?>
                        <span class="product-placeholder">Photo</span>
                    <?php endif; ?>
                </div>

                <div class="product-info">
                    <p class="product-category"><?= htmlspecialchars($product['category']); ?></p>
                    <h3 class="product-name"><?= htmlspecialchars($product['name']); ?></h3>
                    <p class="product-price">&#8369;<?= number_format($product['price'], 2); ?></p>
                </div>
                
                <?php if($product['stock'] > 0): ?>
                <form action="process/add_to_cart.php" method="post">
                    <input type="hidden" name="product_id"    value="<?= $product['id']; ?>">
                    <input type="hidden" name="product_name"  value="<?= htmlspecialchars($product['name']); ?>">
                    <input type="hidden" name="product_price" value="<?= $product['price']; ?>">
                    <input type="hidden" name="product_image" value="<?= htmlspecialchars($product['image']); ?>">
                    <input type="hidden" name="redirect"      value="store.php?category=<?= $category; ?>">
                    <button type="submit" name="submit" class="product-add-btn">Add to Cart</button>
                </form>
                <?php else: ?>
                <button class="product-add-btn" disabled style="opacity:0.4; cursor:not-allowed;">Out of Stock</button>
                <?php endif; ?>
            </div>
            <?php endwhile; ?>
        </div>


        <?php if($total_products == 0): ?>
        <div style="text-align:center; padding: 60px 0; color: var(--charcoal);">
            <p style="font-family: var(--font-display); font-size: 24px; font-weight:300;">No products found.</p>
            <p style="font-size: 13px; margin-top:8px;">Try a different category.</p>
        </div>

        <?php endif; ?>

    </div>
</div>


<?php
    mysqli_close($conn);
    include('include/footer.php');
?>