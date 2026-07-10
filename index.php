<?php 
    session_start();
    $title = "Home";
    $active_nav = "home";

    include('db.php');

    include('include/header.php');
    include('include/navigation.php');
?>

<div class="page-wrapper">

    <!-- HERO -->
    <section class="hero">
        <p class="hero-eyebrow">New Collection — 2025</p>
        <h1 class="hero-title">Dress in your<br><em>own story.</em></h1>
        <p class="hero-subtitle">Effortless pieces for every occasion. Designed for the modern Filipino woman.</p>
        <a href="store.php" class="btn-primary">Shop the Collection</a>
    </section>


     <!-- CATEGORIES -->
    <section class="category-strip">
        <div class="section-header">
            <p class="section-eyebrow">Browse by Category</p>
            <h2 class="section-title">What are you looking for?</h2>
        </div>
        <div class="category-grid">
            <a href="store.php?category=tops" class="category-card">
                <h3>Tops</h3>
                <p>Blouses &amp; Shirts</p>
            </a>
            <a href="store.php?category=bottoms" class="category-card">
                <h3>Bottoms</h3>
                <p>Pants &amp; Skirts</p>
            </a>
            <a href="store.php?category=dresses" class="category-card">
                <h3>Dresses</h3>
                <p>Casual &amp; Formal</p>
            </a>
            <a href="store.php?category=outerwear" class="category-card">
                <h3>Outerwear</h3>
                <p>Jackets &amp; Coats</p>
            </a>
        </div>
    </section>

    <!-- FEATURED PRODUCTS (from database, latest 4) -->
     <section class="products-section">
        <div class="section-header">
            <p class="section-eyebrow">Featured</p>
            <h2 class="section-title">New Arrivals</h2>

            </div>
        <div class="product-grid">
            <?php 
             $sql = "SELECT * FROM tblproducts ORDER BY id DESC LIMIT 4";
            $result = mysqli_query($conn, $sql);
            while($product = mysqli_fetch_assoc($result)): 
            ?>

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
                <form action="process/add_to_cart.php" method="post">
                    <input type="hidden" name="product_id"    value="<?= $product['id']; ?>">
                    <input type="hidden" name="product_name"  value="<?= htmlspecialchars($product['name']); ?>">
                    <input type="hidden" name="product_price" value="<?= $product['price']; ?>">
                    <input type="hidden" name="product_image" value="<?= htmlspecialchars($product['image']); ?>">
                    <button type="submit" name="submit" class="product-add-btn">Add to Cart</button>
                    </form>
                    </div>
            <?php endwhile; ?>
        </div>
         <div style="text-align:center; margin-top: 40px;">
            <a href="store.php" class="btn-outline">View All Products</a>
        </div>
    </section>

</div>

<?php
    mysqli_close($conn);
    include('include/footer.php');
?>