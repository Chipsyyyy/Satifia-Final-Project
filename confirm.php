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