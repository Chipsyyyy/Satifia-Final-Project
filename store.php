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


    </div>
</div>

<?php
    mysqli_close($conn);
    include('include/footer.php');
?>