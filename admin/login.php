<?php
session_start();

$title = "Admin Login";
$css_path = "../css/style.css";
$root_path = "../";

include('../include/header.php');
?>

<div class="page-wrapper">
    <div class="form-page">
        <div class="form-card">
            <h1 class="form-card-title">Admin Panel</h1>
            <p class="form-card-sub">Sign in with your administrator credentials.</p>

            <form action="process/admin_checklogin.php" method="post">
                <div class="form-group">
                    <label class="form-label" for="username">Username</label>
                    <input 
                        type="text" 
                        class="form-control" 
                        name="username" 
                        id="username" 
                        placeholder="Admin username"
                    >
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input 
                        type="password" 
                        class="form-control" 
                        name="password" 
                        id="password" 
                        placeholder="Admin password"
                    >
                </div>

                <button type="submit" name="submit" class="form-submit">
                    Sign In
                </button>
            </form>
        </div>
    </div>
</div>

<?php include('../include/footer.php'); ?>