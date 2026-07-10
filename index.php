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

</div>

<?php
    mysqli_close($conn);
    include('include/footer.php');
?>