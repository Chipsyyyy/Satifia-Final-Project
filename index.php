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

</div>

<?php
    mysqli_close($conn);
    include('include/footer.php');
?>