<?php
    session_start();
    require("db.php");

    $message = "";
    $type = "";

    if(isset($_GET['token']) && !empty($_GET['token'])) {
        $token = mysqli_real_escape_string($conn, $_GET['token']);

        $result = mysqli_query($conn, "SELECT * FROM tblbuyers WHERE confirm_token = '$token'");

        if(mysqli_num_rows($result) == 1) {
            $buyer = mysqli_fetch_assoc($result);

            if($buyer['is_confirmed'] == 1) {
                $message = "Your account has already been confirmed. You may now log in.";
                $type = "success";
            } else {
                mysqli_query($conn, "UPDATE tblbuyers SET is_confirmed = 1, confirm_token = NULL WHERE confirm_token = '$token'");
                $message = "Your account has been successfully confirmed! You may now log in.";
                $type = "success";
            }
        } else {
            $message = "Invalid or expired confirmation link.";
            $type = "danger";
        }
    } else {
        $message = "No confirmation token provided.";
        $type = "danger";
    }

    mysqli_close($conn);

    $title = "Account Confirmation";
    $active_nav = "";
    include('include/header.php');
    include('include/navigation.php');
?>

<div class="page-wrapper">
    <div class="form-page">
        <div class="form-card" style="text-align: center;">
            <h1 class="form-card-title">Account Confirmation</h1>

            <?php if($type == 'success'): ?>
                <div style="margin: 24px 0;">
                    <div style="width: 70px; height: 70px; border-radius: 50%; background-color: #e0f2e9; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 32px;">&#10003;</div>
                    <p style="font-size: 14px; color: var(--charcoal);"><?= $message; ?></p>
                </div>
                <a href="login.php" class="btn-primary">Proceed to Login</a>
            <?php else: ?>
                <div style="margin: 24px 0;">
                    <div style="width: 70px; height: 70px; border-radius: 50%; background-color: #fce4e4; display: flex; align-items: center; justify-content: center; margin: 0 auto 16px; font-size: 32px;">&#10007;</div>
                    <p style="font-size: 14px; color: var(--danger);"><?= $message; ?></p>
                </div>
                <a href="register.php" class="btn-outline">Back to Register</a>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include('include/footer.php'); ?>