<?php
    session_start();

    $title = "Login";
    $active_nav = "";
    include('include/header.php');
    include('include/navigation.php');
?>

<div class="page-wrapper">
    <div class="form-page">
        <div class="form-card">

            <h1 class="form-card-title">Welcome Back</h1>
            <p class="form-card-sub">Sign in to your Satifia account.</p>
        </div>
    </div>
</div>

<?php include('include/footer.php'); ?>