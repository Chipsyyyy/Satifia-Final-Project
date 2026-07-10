<?php
    session_start();
    $title = "Shop";
    $active_nav = "store";

    include('db.php');

    include('include/header.php');
    include('include/navigation.php');
?>

<div class="page-wrapper">

    <div class="page-title-strip">
        <h1>Shop All</h1>
        <p>Discover the latest pieces from Satifia</p>
    </div>

    <div class="store-layout">

    </div>
</div>

<?php
    mysqli_close($conn);
    include('include/footer.php');
?>