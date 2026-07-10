<?php
    session_start();

    // If already logged in, go to store
    if(isset($_SESSION['buyer_id'])) {
        header('Location: store.php');
        exit();
    }

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
            
            <?php if(isset($_SESSION['error'])): ?>
                <div class="alert alert-danger">
                    <p><?= $_SESSION['error']; ?></p>
                </div>
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>

            <?php if(isset($_SESSION['success'])): ?>
                <div class="alert alert-success">
                    <p><?= $_SESSION['success']; ?></p>
                </div>
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <form action="process/checklogin.php" method="post" novalidate>
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" class="form-control" name="email" id="email"
                        placeholder="you@example.com">
                </div>
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password"
                        placeholder="Your password">
                </div>
                <button type="submit" name="submit" class="form-submit">Sign In</button>
            </form>

            <p class="form-footer-text">
                No account yet? <a href="register.php">Register here</a>
            </p>
        </div>
    </div>
</div>

<?php include('include/footer.php'); ?>