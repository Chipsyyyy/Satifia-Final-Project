<?php
    session_start();
    $title = "Create Account";
    $active_nav = "";
    include('include/header.php');
    include('include/navigation.php');
?>

<div class="page-wrapper">
    <div class="form-page">
        <div class="form-card">

            <h1 class="form-card-title">Create Account</h1>
            <p class="form-card-sub">Join Satifia and start shopping.</p>

            <?php if(isset($_SESSION['errors'])): ?>
                <div class="alert alert-danger">
                    <?php foreach($_SESSION['errors'] as $error): ?>
                        <p><?= $error; ?></p>
                    <?php endforeach; ?>
                </div>
                <?php unset($_SESSION['errors']); ?>
            <?php endif; ?>

            <form action="process/checkregister.php" method="post" novalidate>

                <div class="form-group">
                    <label class="form-label" for="fullname">Complete Name</label>
                    <input type="text" class="form-control" name="fullname" id="fullname"
                        placeholder="e.g. Maria Clara Santos"
                        value="<?= isset($_SESSION['form_data']['fullname']) ? htmlspecialchars($_SESSION['form_data']['fullname']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" class="form-control" name="email" id="email"
                        placeholder="you@example.com"
                        value="<?= isset($_SESSION['form_data']['email']) ? htmlspecialchars($_SESSION['form_data']['email']) : ''; ?>">
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password"
                            placeholder="Min. 8 characters">
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="confirmpassword">Confirm Password</label>
                        <input type="password" class="form-control" name="confirmpassword" id="confirmpassword"
                            placeholder="Repeat password">
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="address">Complete Address</label>
                    <input type="text" class="form-control" name="address" id="address"
                        placeholder="Street, Barangay, City, Province"
                        value="<?= isset($_SESSION['form_data']['address']) ? htmlspecialchars($_SESSION['form_data']['address']) : ''; ?>">
                </div>

                <div class="form-group">
                    <label class="form-label" for="contact">Contact Number</label>
                    <input type="text" class="form-control" name="contact" id="contact"
                        placeholder="e.g. 09171234567"
                        value="<?= isset($_SESSION['form_data']['contact']) ? htmlspecialchars($_SESSION['form_data']['contact']) : ''; ?>">
                </div>

                <?php unset($_SESSION['form_data']); ?>

                <button type="submit" name="submit" class="form-submit">Create Account</button>
            </form>
            
            <p class="form-footer-text">
                Already have an account? <a href="login.php">Login here</a>
            </p>
        </div>
    </div>
</div>

<?php include('include/footer.php'); ?>
