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
            </div>
            <?php endwhile; ?>
        </div>

    </div>
</div>

<?php
    mysqli_close($conn);
    include('include/footer.php');
?>